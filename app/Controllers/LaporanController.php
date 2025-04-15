<?php

namespace App\Controllers;

use App\Models\OrderItemModel;
use App\Models\OrderModel;

class LaporanController extends BaseController
{
    protected $orderItemModel;
    protected $orderModel;

    public function __construct()
    {
        $this->orderItemModel = new OrderItemModel();
        $this->orderModel = new OrderModel();
    }

    // Menampilkan halaman laporan dengan data penjualan
    public function index()
    {
        // Ambil data order item yang ada (menyesuaikan dengan kebutuhan)
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
            'judul' => 'Laporan',
            'laporan' => $orders,
        ];



        return view('admin/laporan/laporan_harian', $data);
    }

    public function laporan_bulanan()
    {
        $orderItems = $this->orderItemModel
            ->select('produk.nama_produk, produk.harga, SUM(order_item.jumlah) AS total_jumlah, SUM(order_item.total_harga) AS total_penjualan')
            ->join('produk', 'produk.id_produk = order_item.id_produk')
            ->groupBy('order_item.id_produk, produk.nama_produk, produk.harga')
            ->orderBy('produk.nama_produk', 'ASC')
            ->findAll();

        $totalKeseluruhan = array_sum(array_column($orderItems, 'total_penjualan'));

        $data = [
            'judul' => 'Laporan Penjualan Bulanan',
            'laporan' => $orderItems,
            'totalKeseluruhan' => $totalKeseluruhan,
        ];

        return view('admin/laporan/laporan_bulanan', $data);
    }
}
