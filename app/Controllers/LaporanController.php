<?php

namespace App\Controllers;

use App\Models\OrderItemModel;
use App\Models\OrderModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use CodeIgniter\HTTP\ResponseInterface;

class LaporanController extends BaseController
{
    protected $orderItemModel;
    protected $orderModel;

    public function __construct()
    {
        $this->orderItemModel = new OrderItemModel();
        $this->orderModel = new OrderModel();
    }

    // Menampilkan halaman laporan harian
    public function index()
    {
        // Ambil data order item yang ada
        $orders = $this->orderModel
            ->orderBy('created_at', 'DESC')
            ->findAll();

        $orderItemModel = new \App\Models\OrderItemModel();

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

    // Fungsi kirim laporan harian
    public function kirim_laporan_harian()
    {
        $orders = $this->orderModel
            ->orderBy('created_at', 'DESC')
            ->findAll();
    
        foreach ($orders as &$order) {
            $order['items'] = $this->orderItemModel
                ->select('order_item.*, produk.nama_produk, produk.harga')
                ->join('produk', 'produk.id_produk = order_item.id_produk')
                ->where('order_item.id_order', $order['id_order'])
                ->findAll();
        }
    
        $data = [
            'judul' => 'Laporan',
            'laporan' => $orders,
        ];
    
        // Render HTML dari view
        $view_laporan = view('admin/laporan/pdf_laporan_harian', $data);
    
        // Inisialisasi Dompdf
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view_laporan);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    
        // Ambil output PDF-nya
        $output = $dompdf->output();
    
        // Tentukan path penyimpanan (misalnya: public/laporan/laporan_harian.pdf)
        $path = WRITEPATH . '../public/laporan/';
        if (!is_dir($path)) {
            mkdir($path, 0777, true); // buat folder jika belum ada
        }
    
        $filename = 'laporan_harian_' . date('Ymd_His') . '.pdf';
        file_put_contents($path . $filename, $output);
    
        // Stream ke user (download)
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($output);
    }
    

    // Menampilkan halaman laporan bulanan
    public function laporan_bulanan()
    {
        $orderItems = $this->orderItemModel
            ->select('
            produk.nama_produk, 
            produk.harga, 
            SUM(order_item.jumlah) AS total_jumlah, 
            SUM(order_item.total_harga) AS total_penjualan,
            MAX(order_item.created_at) AS created_at
        ')
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

    // Fungsi kirim laporan bulanan

    public function kirim_laporan_bulanan()
    {
        $orders = $this->orderModel
            ->orderBy('created_at', 'DESC')
            ->findAll();
    
        foreach ($orders as &$order) {
            $order['items'] = $this->orderItemModel
                ->select('order_item.*, produk.nama_produk, produk.harga')
                ->join('produk', 'produk.id_produk = order_item.id_produk')
                ->where('order_item.id_order', $order['id_order'])
                ->findAll();
        }
    
        $data = [
            'judul' => 'Laporan',
            'laporan' => $orders,
        ];
    
        $view_laporan = view('admin/laporan/pdf_laporan_bulanan', $data);
    
        $dompdf = new Dompdf();
        $dompdf->loadHtml($view_laporan);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    
        $output = $dompdf->output();
    
        // Simpan PDF ke folder public/laporan/
        $path = WRITEPATH . '../public/laporan/';
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
    
        $filename = 'laporan_bulanan_' . date('Ymd_His') . '.pdf';
        file_put_contents($path . $filename, $output);
    
        // Stream ke user (download)
        return $this->response
            ->setHeader('Content-Type', 'application/pdf')
            ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
            ->setBody($output);
    }
    

    
}
