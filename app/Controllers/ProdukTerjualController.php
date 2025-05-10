<?php

namespace App\Controllers;

use App\Models\ProdukTerjualModel;
use App\Models\RincianProdukTerjualModel;
use App\Models\ProdukModel;

class ProdukTerjualController extends BaseController
{
    protected $produkTerjualModel;
    protected $rincianProdukTerjualModel;
    protected $produkModel;

    public function __construct()
    {
        $this->produkTerjualModel      = new ProdukTerjualModel();
        $this->rincianProdukTerjualModel  = new RincianProdukTerjualModel();
        $this->produkModel             = new ProdukModel();
    }

    public function index()
    {
        $produkTerjual = $this->produkTerjualModel
            ->orderBy('created_at', 'DESC')
            ->findAll();

        // Loop produk terjual dan ambil rincian produk
        foreach ($produkTerjual as &$produk) {
            $produk['rincian'] = $this->rincianProdukTerjualModel
                ->select('rincian_produk_terjual.*, produk.nama_produk, produk.harga')
                ->join('produk', 'produk.id_produk = rincian_produk_terjual.id_produk')
                ->where('rincian_produk_terjual.id_produk_terjual', $produk['id_produk_terjual'])
                ->findAll();
        }

        $data = [
            'judul' => 'Data Produk Terjual',
            'produkTerjual' => $produkTerjual,
        ];

        return view('admin/produk_terjual/produk_terjual', $data);
    }

    public function tambah()
    {
        $data = [
            'judul' => 'Tambah Produk Terjual',
            'produk' => $this->produkModel->findAll()
        ];

        return view('admin/produk_terjual/tambah', $data);
    }

    public function store()
    {
        // Ambil produk yang dipilih dan jumlah dari form
        $produkIDs = $this->request->getPost('produk');  // Produk yang dipilih
        $jumlahs   = $this->request->getPost('jumlah');  // Jumlah produk yang dipilih

        $totalHarga = 0;
        $items = [];

        if (!empty($produkIDs) && !empty($jumlahs)) {
            // Simpan produk terjual terlebih dahulu
            $produkTerjualData = [
                'total_harga' => 0, // Set total harga sementara dulu
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ];
            $produkTerjualId = $this->produkTerjualModel->insert($produkTerjualData);  // Simpan produk terjual dan ambil ID produk terjual

            // Loop untuk memasukkan data produk yang dipilih
            foreach ($produkIDs as $index => $idProduk) {
                $jumlah = isset($jumlahs[$index]) ? (int) $jumlahs[$index] : 1;  // Ambil jumlah produk
                $produk = $this->produkModel->find($idProduk);  // Ambil data produk dari database

                if ($produk && $jumlah > 0) {
                    // Hitung subtotal per produk (jumlah * harga per produk)
                    $subtotal = $jumlah * $produk['harga'];
                    $totalHarga += $subtotal; // Update total harga produk terjual

                    // Simpan rincian produk terjual yang baru
                    $data = [
                        'id_produk_terjual' => $produkTerjualId,
                        'id_produk'         => $idProduk,
                        'jumlah'            => $jumlah,
                        'total_harga'       => $subtotal,
                        'created_at'        => date('Y-m-d H:i:s'),
                        'updated_at'        => date('Y-m-d H:i:s')
                    ];

                    // Insert data ke rincian_produk_terjual
                    $this->rincianProdukTerjualModel->insert($data);
                }
            }

            // Update total harga untuk produk terjual setelah semua rincian diproses
            $this->produkTerjualModel->update($produkTerjualId, [
                'total_harga' => $totalHarga,
                'updated_at'  => date('Y-m-d H:i:s')
            ]);

            // Redirect kembali ke halaman daftar produk terjual dengan pesan sukses
            return redirect()->to(base_url('admin/produk_terjual'))->with('success', 'Produk Terjual berhasil ditambahkan.');
        } else {
            // Jika tidak ada produk yang dipilih
            return redirect()->to(base_url('admin/produk_terjual'))->with('error', 'Tidak ada produk yang dipilih untuk ditambahkan.');
        }
    }

    public function konfirmasi($produkTerjualId = null)
    {
        $produkDipilih = $this->request->getPost('produk');
        $jumlahProduk  = $this->request->getPost('jumlah');

        // Cek apakah ini adalah form edit
        $produkTerpilih = [];

        if (!empty($produkDipilih)) {
            foreach ($produkDipilih as $idProduk) {
                $produk = $this->produkModel->find($idProduk);
                if ($produk) {
                    $jumlah = isset($jumlahProduk[$idProduk]) ? (int)$jumlahProduk[$idProduk] : 1;
                    $produk['jumlah'] = $jumlah;
                    $produk['subtotal'] = $jumlah * $produk['harga'];
                    $produkTerpilih[] = $produk;
                }
            }
        }

        // Jika produkTerjualId ada, berarti kita sedang mengedit
        if ($produkTerjualId) {
            // Ambil data produk terjual berdasarkan produk_terjual_id
            $produkTerjual = $this->produkTerjualModel->find($produkTerjualId);
            if ($produkTerjual) {
                // Ambil produk yang sudah ada di produk terjual
                $produkItems = $this->rincianProdukTerjualModel->where('id_produk_terjual', $produkTerjualId)->findAll();
                // Gabungkan produk yang sudah ada dengan produk yang dipilih
                $produkTerpilih = array_merge($produkItems, $produkTerpilih);
            }
        }

        return view('admin/produk_terjual/konfirmasi', [
            'judul' => 'Konfirmasi Produk Terjual',
            'produk_terpilih' => $produkTerpilih,
            'produk_terjual_id' => $produkTerjualId // Kirimkan produk_terjual_id jika mengedit
        ]);
    }

    public function simpan()
    {
        $produkTerjualId = $this->request->getPost('produk_terjual_id');
        $produk = $this->request->getPost('produk');

        // Jika produk_terjual_id ada, maka kita lakukan update
        if ($produkTerjualId) {
            // Update data produk terjual
            $this->produkTerjualModel->update($produkTerjualId, [
                'total_harga' => $this->request->getPost('total_harga'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // Hapus data rincian produk lama
            $this->rincianProdukTerjualModel->where('id_produk_terjual', $produkTerjualId)->delete();
        } else {
            // Jika produk_terjual_id tidak ada, berarti menambah produk terjual baru
            $produkTerjualId = $this->produkTerjualModel->insert([
                'total_harga' => $this->request->getPost('total_harga'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        // Insert atau update rincian produk
        foreach ($produk as $item) {
            $subtotal = $item['jumlah'] * $item['harga'];
            $data = [
                'id_produk_terjual' => $produkTerjualId,
                'jumlah'            => $item['jumlah'],
                'total_harga'       => $subtotal,
                'id_produk'         => $item['id_produk'],
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s')
            ];

            $this->rincianProdukTerjualModel->insert($data);
        }

        return redirect()->to(base_url('admin/produk_terjual'))->with('success', 'Produk Terjual berhasil ditambahkan!');
    }

    public function edit($id_produk_terjual)
    {
        $produkTerjual = $this->produkTerjualModel->find($id_produk_terjual);
        $produkItems = $this->rincianProdukTerjualModel->where('id_produk_terjual', $id_produk_terjual)->findAll();

        return view('admin/produk_terjual/edit', [
            'produkTerjual' => $produkTerjual,
            'produkItems'   => $produkItems,
            'produkModel'   => $this->produkModel,
            'judul'         => 'Edit Produk Terjual'
        ]);
    }

    public function update($produkTerjualId)
    {
        // Ambil produk dan jumlah yang dipilih dari form
        $produkIDs = $this->request->getPost('produk_id');  // Produk yang dipilih
        $jumlahs   = $this->request->getPost('jumlah');     // Jumlah produk yang dipilih
        $totalHarga = 0;

        if (!empty($produkIDs) && !empty($jumlahs)) {
            // Loop untuk memasukkan data baru
            foreach ($produkIDs as $index => $idProduk) {
                $jumlah = isset($jumlahs[$index]) ? (int) $jumlahs[$index] : 1;  // Ambil jumlah produk
                $produk = $this->produkModel->find($idProduk);  // Ambil data produk dari database

                if ($produk && $jumlah > 0) {
                    // Hitung subtotal
                    $subtotal = $jumlah * $produk['harga'];
                    $totalHarga += $subtotal;

                    // Cek apakah produk sudah ada di produk terjual
                    $existingItem = $this->rincianProdukTerjualModel->where('id_produk_terjual', $produkTerjualId)
                        ->where('id_produk', $idProduk)
                        ->first();

                    if ($existingItem) {
                        // Jika produk sudah ada, update jumlah dan total harga
                        $this->rincianProdukTerjualModel->update($existingItem['id_rincian_produk_terjual'], [
                            'jumlah'      => $jumlah,
                            'total_harga' => $subtotal,
                            'updated_at'  => date('Y-m-d H:i:s'),
                        ]);
                    } else {
                        // Jika produk belum ada, insert data baru
                        $data = [
                            'id_produk_terjual' => $produkTerjualId,
                            'id_produk'         => $idProduk,
                            'jumlah'            => $jumlah,
                            'total_harga'       => $subtotal,
                            'created_at'        => date('Y-m-d H:i:s'),
                            'updated_at'        => date('Y-m-d H:i:s')
                        ];

                        $this->rincianProdukTerjualModel->insert($data);
                    }
                }
            }

            // Update total harga untuk produk terjual
            $this->produkTerjualModel->update($produkTerjualId, [
                'total_harga' => $totalHarga,
                'updated_at'  => date('Y-m-d H:i:s')
            ]);

            // Redirect kembali ke halaman daftar produk terjual dengan pesan sukses
            return redirect()->to(base_url('admin/produk_terjual'))->with('success', 'Produk Terjual berhasil diperbarui!');
        } else {
            // Jika tidak ada produk atau jumlah yang dipilih
            return redirect()->to(base_url('admin/produk_terjual/edit/' . $produkTerjualId))->with('error', 'Tidak ada produk yang dipilih untuk diupdate.');
        }
    }

    public function delete($id_produk_terjual)
    {
        // Hapus data rincian produk terlebih dahulu
        $this->rincianProdukTerjualModel->where('id_produk_terjual', $id_produk_terjual)->delete();

        // Hapus data utama produk terjual
        $this->produkTerjualModel->delete($id_produk_terjual);

        // Set pesan berhasil dan redirect ke halaman utama produk terjual
        session()->setFlashdata('success', 'Produk Terjual berhasil dihapus.');
        return redirect()->to(base_url('admin/produk_terjual'));
    }
}
