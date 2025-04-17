<?php

namespace App\Controllers;

use App\Models\OrderModel;
use App\Models\OrderItemModel;
use App\Models\LaporanModel;
use Carbon\Carbon;

class ArsipLaporanController extends BaseController
{
    protected $orderModel;
    protected $orderItemModel;
    protected $laporanModel;

    public function __construct()
    {
        $this->orderModel = new OrderModel();
        $this->orderItemModel = new OrderItemModel();
        $this->laporanModel = new LaporanModel();
    }

    // Halaman awal arsip laporan per hari
    public function index()
    {
        $data['judul'] = 'Arsip Laporan Penjualan PerHari';
        $laporan = $this->laporanModel->where('kategori', 'perhari')->findAll();

        // Format tanggal dengan Carbon
        foreach ($laporan as &$item) {
            $item['created_at'] = Carbon::parse($item['created_at'])->locale('id')->isoFormat('dddd, D MMMM YYYY');
        }

        $data['laporan'] = $laporan;


        return view('admin/arsip_laporan/arsip_laporan_perhari', $data);
    }


    public function perbulan()
    {
        $data['judul'] = 'Arsip Laporan Penjualan PerBulan';
        $laporan = $this->laporanModel->where('kategori', 'perbulan')->findAll();

        // Format tanggal dengan Carbon
        foreach ($laporan as &$item) {
            $item['created_at'] = Carbon::parse($item['created_at'])->locale('id')->isoFormat('MMMM YYYY');
        }

        $data['laporan'] = $laporan;


        return view('admin/arsip_laporan/arsip_laporan_perbulan', $data);
    }
}
