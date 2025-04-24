<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\ProdukModel;

class ProdukTerjualController extends BaseController
{
    protected $orderModel;
    protected $orderItemModel;
    protected $produkModel;

    public function __construct()
    {
        $this->orderModel      = new OrderModel();
        $this->orderItemModel  = new OrderItemModel();
        $this->produkModel     = new ProdukModel();
    }

    public function index()
    {
        $orders = $this->orderModel
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $orderItemModel = new \App\Models\OrderItemModel(); // Pastikan kamu punya ini

        // Loop order dan ambil item-order-nya
        foreach ($orders as &$order) {
            $order['items'] = $orderItemModel
                ->select('order_item.*, produk.nama_produk, produk.harga')
                ->join('produk', 'produk.id_produk = order_item.id_produk')
                ->where('order_item.id_order', $order['id_order'])
                ->findAll();
        }

        $data = [
            'judul' => 'Data Produk Terjual',
            'orders' => $orders,
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

    public function konfirmasi($orderId = null)
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

        // Jika orderId ada, berarti kita sedang mengedit
        if ($orderId) {
            // Ambil data order berdasarkan order_id
            $order = $this->orderModel->find($orderId);
            if ($order) {
                // Ambil produk yang sudah ada di order
                $produkItems = $this->orderItemModel->where('id_order', $orderId)->findAll();
                // Gabungkan produk yang sudah ada dengan produk yang dipilih
                $produkTerpilih = array_merge($produkItems, $produkTerpilih);
            }
        }

        return view('admin/produk_terjual/konfirmasi', [
            'judul' => 'Konfirmasi Produk Terjual',
            'produk_terpilih' => $produkTerpilih,
            'order_id' => $orderId // Kirimkan order_id jika mengedit
        ]);
    }

    public function simpan()
    {
        $orderId = $this->request->getPost('order_id');
        $produk = $this->request->getPost('produk');

        // Jika order_id ada, maka kita lakukan update
        if ($orderId) {
            // Update data order
            $this->orderModel->update($orderId, [
                'total_harga' => $this->request->getPost('total_harga'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            // Hapus data order item lama
            $this->orderItemModel->where('id_order', $orderId)->delete();
        } else {
            // Jika order_id tidak ada, berarti menambah order baru
            $orderId = $this->orderModel->insert([
                'total_harga' => $this->request->getPost('total_harga'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        // Insert atau update item produk
        foreach ($produk as $item) {
            $subtotal = $item['jumlah'] * $item['harga'];
            $data = [
                'id_order'    => $orderId,
                'jumlah'      => $item['jumlah'],
                'total_harga' => $subtotal,
                'id_produk'   => $item['id_produk'],
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ];

            $this->orderItemModel->insert($data);
        }

        return redirect()->to(base_url('admin/produk_terjual'))->with('success', 'Produk Terjual berhasil disimpan!');
    }


    public function store()
    {
        $produkIDs = $this->request->getPost('id_produk');
        $jumlahs   = $this->request->getPost('jumlah');

        if ($produkIDs && $jumlahs) {
            $totalHarga = 0;
            $items = [];

            foreach ($produkIDs as $order => $id_produk) {
                $produk = $this->produkModel->find($id_produk);
                if ($produk) {
                    $jumlah = (int) $jumlahs[$order];
                    $subtotal = $jumlah * $produk['harga'];
                    $totalHarga += $subtotal;

                    $items[] = [
                        'id_produk'   => $id_produk,
                        'jumlah'      => $jumlah,
                        'total_harga' => $subtotal
                    ];
                }
            }

            // Simpan ke tabel order
            $orderData = [
                'total_harga' => $totalHarga
            ];
            $this->orderModel->insert($orderData);
            $orderId = $this->orderModel->getInsertID();

            // Simpan item order
            foreach ($items as $item) {
                $item['id_order'] = $orderId;
                $this->orderItemModel->insert($item);
            }

            session()->setFlashdata('pesan', 'Produk Terjual berhasil disimpan!');
        } else {
            session()->setFlashdata('error', 'Tidak ada data produk terjual yang disimpan.');
        }

        return redirect()->to('/admin/produk_terjual');
    }

    public function detail($id)
    {
        $order = $this->orderModel->find($id);
        if (!$order) {
            return redirect()->to('/admin/order')->with('error', 'Order tidak ditemukan.');
        }

        $items = $this->orderItemModel
            ->select('order_item.*, produk.nama_produk, produk.gambar')
            ->join('produk', 'produk.id_produk = order_item.id_produk')
            ->where('id_order', $id)
            ->findAll();

        return view('admin/produk_terjual/detail', [
            'judul' => 'Detail Produk Terjual',
            'order' => $order,
            'items' => $items
        ]);
    }



    public function edit($id_order)
    {
        $order = $this->orderModel->find($id_order);
        $orderItems = $this->orderItemModel->where('id_order', $id_order)->findAll();

        return view('admin/produk_terjual/edit', [
            'order' => $order,
            'orderItems' => $orderItems,
            'produkModel' => $this->produkModel,
            'judul' => 'Edit Produk Terjual'
        ]);
    }

    public function konfirmasi_edit($orderId)
    {
        $produkDipilih = $this->request->getPost('produk_id');
        $jumlahProduk  = $this->request->getPost('jumlah');
        $produkTerpilih = [];

        // Ambil produk dari input POST (jika ada perubahan)
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

        // Tambahkan data order sebelumnya jika belum ada perubahan dari form
        if (empty($produkTerpilih)) {
            $produkItems = $this->orderItemModel
                ->select('order_item.*, produk.nama_produk, produk.harga')
                ->join('produk', 'produk.id_produk = order_item.id_produk')
                ->where('order_item.id_order', $orderId)
                ->findAll();

            $produkTerpilih = $produkItems;
        }

        return view('admin/produk_terjual/konfirmasi_edit', [
            'judul' => 'Konfirmasi Edit Produk Terjual',
            'produk_terpilih' => $produkTerpilih,
            'order_id' => $orderId
        ]);
    }

    public function update($orderId)
    {
        $produk = $this->request->getPost('produk');
        $totalHarga = 0;

        if (!empty($produk)) {
            // Hapus order item lama
            $this->orderItemModel->where('id_order', $orderId)->delete();

            foreach ($produk as $item) {
                $jumlah = $item['jumlah'];
                $harga = $item['harga'];
                $subtotal = $jumlah * $harga;

                $totalHarga += $subtotal;

                $data = [
                    'id_order' => $orderId,
                    'id_produk' => $item['id_produk'],
                    'jumlah' => $jumlah,
                    'total_harga' => $subtotal,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $this->orderItemModel->insert($data);
            }

            // Update total order
            $this->orderModel->update($orderId, [
                'total_harga' => $totalHarga,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->to(base_url('admin/produk_terjual'))->with('success', 'Produk Terjual berhasil diperbarui.');
    }


    public function delete($id_order)
    {
        // Hapus data item order terlebih dahulu
        $this->orderItemModel->where('id_order', $id_order)->delete();

        // Hapus data utama order
        $this->orderModel->delete($id_order);

        // Set pesan berhasil dan redirect ke halaman utama order
        session()->setFlashdata('success', 'Produk Terjual berhasil dihapus.');
        return redirect()->to(base_url('admin/produk_terjual'));
    }
}
