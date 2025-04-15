<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\ProdukModel;

class OrderController extends BaseController
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
            'judul' => 'Data Order',
            'orders' => $orders,
        ];

        return view('admin/order/index', $data);
    }


    public function tambah()
    {
        $data = [
            'judul' => 'Tambah Order',
            'produk' => $this->produkModel->findAll()
        ];

        return view('admin/order/tambah', $data);
    }

    public function konfirmasi()
    {
        $produkDipilih = $this->request->getPost('produk');
        $jumlahProduk  = $this->request->getPost('jumlah');

        if (empty($produkDipilih)) {
            return redirect()->to(base_url('admin/order'))->with('error', 'Tidak ada produk yang dipilih.');
        }

        $produkTerpilih = [];

        foreach ($produkDipilih as $idProduk) {
            $produk = $this->produkModel->find($idProduk);
            if ($produk) {
                $jumlah = isset($jumlahProduk[$idProduk]) ? (int)$jumlahProduk[$idProduk] : 1;
                $produk['jumlah'] = $jumlah;
                $produk['subtotal'] = $jumlah * $produk['harga'];
                $produkTerpilih[] = $produk;
            }
        }

        return view('admin/order/konfirmasi', [
            'judul' => 'Konfirmasi Order',
            'produk_terpilih' => $produkTerpilih
        ]);
    }

    public function simpan()
    {
        $produk = $this->request->getPost('produk');

        $idOrder = $this->orderModel->insert([
            'total_harga' => $this->request->getPost('total_harga'),
        ]);

        // Ambil ID yang baru saja di-insert
        $idOrder = $this->orderModel->getInsertID();



        foreach ($produk as $item) {
            $subtotal = $item['jumlah'] * $item['harga'];
            $data = [
                'id_order'    => $idOrder,
                'jumlah'      => $item['jumlah'],
                'total_harga'       => $subtotal,
                'id_produk'   => $item['id_produk'],
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->orderItemModel->insert($data);
        }

        return redirect()->to(base_url('admin/order'))->with('success', 'Order berhasil disimpan!');
    }


    public function store()
    {
        $produkIDs = $this->request->getPost('id_produk');
        $jumlahs   = $this->request->getPost('jumlah');

        if ($produkIDs && $jumlahs) {
            $totalHarga = 0;
            $items = [];

            foreach ($produkIDs as $index => $id_produk) {
                $produk = $this->produkModel->find($id_produk);
                if ($produk) {
                    $jumlah = (int) $jumlahs[$index];
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

            session()->setFlashdata('pesan', 'Order berhasil disimpan!');
        } else {
            session()->setFlashdata('error', 'Tidak ada data order yang disimpan.');
        }

        return redirect()->to('/admin/order');
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

        return view('admin/order/detail', [
            'judul' => 'Detail Order',
            'order' => $order,
            'items' => $items
        ]);
    }

    public function delete($id_order)
    {
        // Hapus data item order terlebih dahulu
        $this->orderItemModel->where('id_order', $id_order)->delete();
    
        // Hapus data utama order
        $this->orderModel->delete($id_order);
    
        // Set pesan berhasil dan redirect ke halaman utama order
        session()->setFlashdata('success', 'Order berhasil dihapus.');
        return redirect()->to(base_url('admin/order'));
    }
    
    
}
