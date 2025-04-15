<?php

namespace App\Controllers;

use App\Models\LaporanModel;

class ArsipLaporanController extends BaseController
{
    protected $laporanModel;

    public function __construct()
    {
        $this->laporanModel = new LaporanModel();
    }

    // Menampilkan halaman arsip laporan dengan form untuk memilih tanggal
    public function index()
    {
        $data['judul'] = 'Arsip Laporan Penjualan';
        return view('admin/laporan', $data); // Pastikan view ini ada
    }

    // Mengambil data laporan berdasarkan rentang tanggal yang dipilih
    public function generateLaporan()
    {
        $tanggal_awal = $this->request->getPost('tanggal_awal');
        $tanggal_akhir = $this->request->getPost('tanggal_akhir');

        // Validasi input tanggal
        if (!$tanggal_awal || !$tanggal_akhir) {
            return redirect()->back()->with('error', 'Tanggal awal dan akhir harus diisi.');
        }

        // Ambil data penjualan dari model berdasarkan rentang tanggal
        $data['penjualan'] = $this->laporanModel->getPenjualanByDateRange($tanggal_awal, $tanggal_akhir);
        $data['judul'] = 'Arsip Laporan Penjualan ' . date('d M Y', strtotime($tanggal_awal)) . ' - ' . date('d M Y', strtotime($tanggal_akhir));

        return view('admin/laporan', $data); // View yang sama akan digunakan untuk tampilkan hasil
    }
}
