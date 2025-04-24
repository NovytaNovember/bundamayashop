<?php

namespace App\Controllers;

use App\Models\ProdukTerjualModel;
use App\Models\ItemTerjualModel;
use App\Models\ProdukModel;

class ProdukTerjualController extends BaseController
{
    protected $produkTerjualModel;
    protected $itemTerjualModel;
    protected $produkModel;

    public function __construct()
    {
        $this->produkTerjualModel = new ProdukTerjualModel();
        $this->itemTerjualModel   = new ItemTerjualModel();
        $this->produkModel        = new ProdukModel();
    }

    public function index()
    {
        $produkTerjuals = $this->produkTerjualModel
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $itemTerjualModel = new \App\Models\ItemTerjualModel();

        foreach ($produkTerjuals as &$produkTerjual) {
            $produkTerjual['items'] = $itemTerjualModel
                ->select('item_terjual.*, produk.nama_produk, produk.harga')
                ->join('produk', 'produk.id_produk = item_terjual.id_produk')
                ->where('item_terjual.id_produk_terjual', $produkTerjual['id_produk_terjual'])
                ->findAll();
        }

        $data = [
            'judul'          => 'Data Produk Terjual',
            'produkTerjuals' => $produkTerjuals,
        ];

        return view('admin/produk_terjual/produk_terjual', $data);
    }

    public function tambah()
    {
        $data = [
            'judul'  => 'Tambah Produk Terjual',
            'produk' => $this->produkModel->findAll()
        ];

        return view('admin/produk_terjual/tambah', $data);
    }

    public function konfirmasi($produkTerjualId = null)
    {
        $produkDipilih = $this->request->getPost('produk');
        $jumlahProduk  = $this->request->getPost('jumlah');

        $produkTerpilih = [];

        if (!empty($produkDipilih)) {
            foreach ($produkDipilih as $idProduk) {
                $produk = $this->produkModel->find($idProduk);
                if ($produk) {
                    $jumlah = isset($jumlahProduk[$idProduk]) ? (int)$jumlahProduk[$idProduk] : 1;
                    $produk['jumlah']   = $jumlah;
                    $produk['subtotal'] = $jumlah * $produk['harga'];
                    $produkTerpilih[]   = $produk;
                }
            }
        }

        if ($produkTerjualId) {
            $produkTerjual = $this->produkTerjualModel->find($produkTerjualId);
            if ($produkTerjual) {
                $itemTerjuals   = $this->itemTerjualModel->where('id_produk_terjual', $produkTerjualId)->findAll();
                $produkTerpilih = array_merge($itemTerjuals, $produkTerpilih);
            }
        }

        return view('admin/produk_terjual/konfirmasi', [
            'judul'            => 'Konfirmasi Produk Terjual',
            'produk_terpilih'  => $produkTerpilih,
            'produkTerjual_id' => $produkTerjualId
        ]);
    }

    public function simpan()
    {
        
        dd('TES');
        $produkTerjualId = $this->request->getPost('produkTerjual_id');
        
        $produk          = $this->request->getPost('produk');

        if ($produkTerjualId) {
            $this->produkTerjualModel->update($produkTerjualId, [
                'total_harga' => $this->request->getPost('total_harga'),
                'updated_at'  => date('Y-m-d H:i:s')
            ]);

            $this->itemTerjualModel->where('id_produk_terjual', $produkTerjualId)->delete();
        } else {
            $produkTerjualId = $this->produkTerjualModel->insert([
                'total_harga' => $this->request->getPost('total_harga'),
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ]);
        }

        foreach ($produk as $item) {
            $subtotal = $item['jumlah'] * $item['harga'];
            $data = [
                'id_produk_terjual' => $produkTerjualId,
                'id_produk'         => $item['id_produk'],
                'jumlah'            => $item['jumlah'],
                'total_harga'       => $subtotal,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s')
            ];

            $this->itemTerjualModel->insert($data);
        }

        return redirect()->to(base_url('admin/produk_terjual'))->with('success', 'Produk Terjual berhasil disimpan!');
    }

    public function store()
    {
        
        $produkIDs = $this->request->getPost('id_produk');
        $jumlahs   = $this->request->getPost('jumlah');

        if ($produkIDs && $jumlahs) {
            $totalHarga = 0;
            $items      = [];

            foreach ($produkIDs as $index => $id_produk) {
                $produk = $this->produkModel->find($id_produk);
                if ($produk) {
                    $jumlah   = (int) $jumlahs[$index];
                    $subtotal = $jumlah * $produk['harga'];
                    $totalHarga += $subtotal;

                    $items[] = [
                        'id_produk'   => $id_produk,
                        'jumlah'      => $jumlah,
                        'total_harga' => $subtotal
                    ];
                }
            }

            $produkTerjualId = $this->produkTerjualModel->insert([
                'total_harga' => $totalHarga
            ]);

            foreach ($items as $item) {
                $item['id_produk_terjual'] = $produkTerjualId;
                $this->itemTerjualModel->insert($item);
            }

            session()->setFlashdata('pesan', 'Produk Terjual berhasil disimpan!');
        } else {
            session()->setFlashdata('error', 'Tidak ada data produk terjual yang disimpan.');
        }

        return redirect()->to('/admin/produk_terjual');
    }

    public function detail($id)
    {
        $produkTerjual = $this->produkTerjualModel->find($id);
        if (!$produkTerjual) {
            return redirect()->to('/admin/produk_terjual')->with('error', 'Data tidak ditemukan.');
        }

        $items = $this->itemTerjualModel
            ->select('item_terjual.*, produk.nama_produk, produk.gambar')
            ->join('produk', 'produk.id_produk = item_terjual.id_produk')
            ->where('id_produk_terjual', $id)
            ->findAll();

        return view('admin/produk_terjual/detail', [
            'judul'          => 'Detail Produk Terjual',
            'produkTerjual'  => $produkTerjual,
            'items'          => $items
        ]);
    }

    public function edit($id)
    {
        $produkTerjual = $this->produkTerjualModel->find($id);
        $itemTerjuals  = $this->itemTerjualModel->where('id_produk_terjual', $id)->findAll();

        return view('admin/produk_terjual/edit', [
            'produkTerjual' => $produkTerjual,
            'itemTerjuals'  => $itemTerjuals,
            'produkModel'   => $this->produkModel,
            'judul'         => 'Edit Produk Terjual'
        ]);
    }

    public function konfirmasi_edit($produkTerjualId)
    {
        $produkDipilih = $this->request->getPost('produk_id');
        $jumlahProduk  = $this->request->getPost('jumlah');
        $produkTerpilih = [];

        if (!empty($produkDipilih)) {
            foreach ($produkDipilih as $idProduk) {
                $produk = $this->produkModel->find($idProduk);
                if ($produk) {
                    $jumlah = isset($jumlahProduk[$idProduk]) ? (int)$jumlahProduk[$idProduk] : 1;
                    $produk['jumlah']   = $jumlah;
                    $produk['subtotal'] = $jumlah * $produk['harga'];
                    $produkTerpilih[]   = $produk;
                }
            }
        }

        if (empty($produkTerpilih)) {
            $produkTerpilih = $this->itemTerjualModel
                ->select('item_terjual.*, produk.nama_produk, produk.harga')
                ->join('produk', 'produk.id_produk = item_terjual.id_produk')
                ->where('item_terjual.id_produk_terjual', $produkTerjualId)
                ->findAll();
        }

        return view('admin/produk_terjual/konfirmasi_edit', [
            'judul'            => 'Konfirmasi Edit Produk Terjual',
            'produk_terpilih'  => $produkTerpilih,
            'produkTerjual_id' => $produkTerjualId
        ]);
    }

    public function update($produkTerjualId)
    {
        $produk     = $this->request->getPost('produk');
        $totalHarga = 0;

        if (!empty($produk)) {
            $this->itemTerjualModel->where('id_produk_terjual', $produkTerjualId)->delete();

            foreach ($produk as $item) {
                $subtotal   = $item['jumlah'] * $item['harga'];
                $totalHarga += $subtotal;

                $this->itemTerjualModel->insert([
                    'id_produk_terjual' => $produkTerjualId,
                    'id_produk'         => $item['id_produk'],
                    'jumlah'            => $item['jumlah'],
                    'total_harga'       => $subtotal,
                    'created_at'        => date('Y-m-d H:i:s'),
                    'updated_at'        => date('Y-m-d H:i:s')
                ]);
            }

            $this->produkTerjualModel->update($produkTerjualId, [
                'total_harga' => $totalHarga,
                'updated_at'  => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->to(base_url('admin/produk_terjual'))->with('success', 'Produk Terjual berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->itemTerjualModel->where('id_produk_terjual', $id)->delete();
        $this->produkTerjualModel->delete($id);

        session()->setFlashdata('success', 'Produk Terjual berhasil dihapus.');
        return redirect()->to(base_url('admin/produk_terjual'));
    }
}
