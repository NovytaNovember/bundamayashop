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
        // Ambil produk yang dipilih dan jumlah dari form
        $produkIDs = $this->request->getPost('produk');  // Produk yang dipilih
        $jumlahs   = $this->request->getPost('jumlah');  // Jumlah produk yang dipilih

        $totalHarga = 0;
        $items = [];

        if (!empty($produkIDs) && !empty($jumlahs)) {
            // Simpan order terlebih dahulu
            $orderData = [
                'total_harga' => 0, // Set total harga sementara dulu
                'created_at'  => date('Y-m-d H:i:s'),
                'updated_at'  => date('Y-m-d H:i:s')
            ];
            $orderId = $this->orderModel->insert($orderData);  // Simpan order dan ambil ID order

            // Loop untuk memasukkan data produk yang dipilih
            foreach ($produkIDs as $index => $idProduk) {
                $jumlah = isset($jumlahs[$index]) ? (int) $jumlahs[$index] : 1;  // Ambil jumlah produk
                $produk = $this->produkModel->find($idProduk);  // Ambil data produk dari database

                if ($produk && $jumlah > 0) {
                    // Hitung subtotal per produk (jumlah * harga per produk)
                    $subtotal = $jumlah * $produk['harga'];
                    $totalHarga += $subtotal; // Update total harga order

                    // Simpan item order yang baru
                    $data = [
                        'id_order'    => $orderId,
                        'id_produk'   => $idProduk,
                        'jumlah'      => $jumlah,
                        'total_harga' => $subtotal,
                        'created_at'  => date('Y-m-d H:i:s'),
                        'updated_at'  => date('Y-m-d H:i:s')
                    ];

                    // Insert data ke order_item
                    $this->orderItemModel->insert($data);
                }
            }

            // Update total harga untuk order setelah semua item diproses
            $this->orderModel->update($orderId, [
                'total_harga' => $totalHarga,
                'updated_at'  => date('Y-m-d H:i:s')
            ]);

            // Redirect kembali ke halaman daftar produk terjual dengan pesan sukses
            return redirect()->to(base_url('admin/produk_terjual'))->with('success', 'Produk Terjual berhasil disimpan.');
        } else {
            // Jika tidak ada produk yang dipilih
            return redirect()->to(base_url('admin/produk_terjual'))->with('error', 'Tidak ada produk yang dipilih untuk disimpan.');
        }
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

    public function update($orderId)
{
    // Ambil produk dan jumlah yang dipilih dari form
    $produkIDs = $this->request->getPost('produk_id');  // Produk yang dipilih
    $jumlahs   = $this->request->getPost('jumlah');     // Jumlah produk yang dipilih
    $totalHarga = 0;

    // Debugging: Cek produk yang diterima
    log_message('debug', 'Produk yang diterima: ' . print_r($produkIDs, true));
    log_message('debug', 'Jumlah produk yang diterima: ' . print_r($jumlahs, true));

    // Jika ada produk yang dipilih dan jumlahnya
    if (!empty($produkIDs) && !empty($jumlahs)) {
        // Loop untuk memasukkan data baru
        foreach ($produkIDs as $index => $idProduk) {
            $jumlah = isset($jumlahs[$index]) ? (int) $jumlahs[$index] : 1;  // Ambil jumlah produk
            $produk = $this->produkModel->find($idProduk);  // Ambil data produk dari database

            if ($produk && $jumlah > 0) {
                // Hitung subtotal
                $subtotal = $jumlah * $produk['harga'];
                $totalHarga += $subtotal;

                // Cek apakah produk sudah ada di order
                $existingItem = $this->orderItemModel->where('id_order', $orderId)
                                                      ->where('id_produk', $idProduk)
                                                      ->first();

                if ($existingItem) {
                    // Jika produk sudah ada, update jumlah dan total harga
                    $this->orderItemModel->update($existingItem['id_order_item'], [
                        'jumlah'      => $jumlah,
                        'total_harga' => $subtotal,
                        'updated_at'  => date('Y-m-d H:i:s'),
                    ]);
                } else {
                    // Jika produk belum ada di order, insert data baru
                    $data = [
                        'id_order'    => $orderId,
                        'id_produk'   => $idProduk,
                        'jumlah'      => $jumlah,
                        'total_harga' => $subtotal,
                        'created_at'  => date('Y-m-d H:i:s'),
                        'updated_at'  => date('Y-m-d H:i:s')
                    ];

                    // Insert data ke order_item
                    $this->orderItemModel->insert($data);
                }
            }
        }

        // Update total harga untuk order
        $this->orderModel->update($orderId, [
            'total_harga' => $totalHarga,
            'updated_at'  => date('Y-m-d H:i:s')
        ]);

        // Redirect kembali ke halaman daftar produk terjual dengan pesan sukses
        return redirect()->to(base_url('admin/produk_terjual'))->with('success', 'Produk Terjual berhasil diperbarui!');
    } else {
        // Jika tidak ada produk atau jumlah yang dipilih
        return redirect()->to(base_url('admin/produk_terjual/edit/' . $orderId))->with('error', 'Tidak ada produk yang dipilih untuk diupdate.');
    }
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
