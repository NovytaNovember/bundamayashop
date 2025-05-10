<?php

namespace App\Controllers;

use App\Models\ProdukModel;
use App\Models\KategoriModel;
use App\Models\ProdukTerjualModel;  // Tambahkan model ProdukTerjual
use App\Models\RincianProdukTerjualModel;  // Tambahkan model RincianProdukTerjual
use App\Models\LaporanModel;  // Model Laporan jika perlu

class DashboardController extends BaseController
{
    public function index()
    {
        // Mengambil session pengguna
        $session = session();
        $userLevel = $session->get('level');  // Ambil level pengguna dari session

        // Inisialisasi model
        $produkModel = new ProdukModel();
        $kategoriModel = new KategoriModel();
        $produkTerjualModel = new ProdukTerjualModel();  // Inisialisasi model ProdukTerjual
        $rincianProdukTerjualModel = new RincianProdukTerjualModel();  // Inisialisasi model RincianProdukTerjual

        // Menghitung total produk dan kategori
        $totalProduk = $produkModel->countAll();
        $totalKategori = $kategoriModel->countAll();

        // Ambil data hari ini dan bulan ini
        $hariIni = date('Y-m-d');  // Format tanggal hari ini
        $bulanIni = date('m');     // Bulan ini
        $tahunIni = date('Y');     // Tahun ini

        // Ambil total produk terjual hari ini
        $totalProdukHarian = $produkTerjualModel
            ->where('DATE(created_at)', $hariIni)  // Filter berdasarkan tanggal hari ini
            ->selectSum('total_harga')  // Jumlahkan total harga penjualan
            ->first()['total_harga'] ?? 0;

        // Ambil total produk terjual bulan ini
        $totalProdukBulanan = $produkTerjualModel
            ->where('MONTH(created_at)', $bulanIni)  // Filter berdasarkan bulan ini
            ->where('YEAR(created_at)', $tahunIni)  // Filter berdasarkan tahun ini
            ->selectSum('total_harga')  // Jumlahkan total harga penjualan
            ->first()['total_harga'] ?? 0;

        // Menyusun data untuk dikirim ke view
        $data = [
            'judul' => 'Dashboard',
            'totalProduk' => $totalProduk,
            'totalKategori' => $totalKategori,
            'totalProdukHarian' => number_format($totalProdukHarian, 0, ',', '.'), // Format untuk harian
            'totalProdukBulanan' => number_format($totalProdukBulanan, 0, ',', '.'), // Format untuk bulanan
        ];

        // Redirect ke halaman yang sesuai berdasarkan level pengguna
        if ($userLevel == 'admin') {
            return view('admin/dashboard', $data);  // Tampilkan dashboard admin
        } elseif ($userLevel == 'petugas') {
            return view('petugas/dashboard', $data);  // Tampilkan dashboard petugas
        } elseif ($userLevel == 'owner') {
            return view('owner/dashboard', $data);  // Tampilkan dashboard owner
        } else {
            // Jika level tidak sesuai, redirect ke halaman login
            return redirect()->to('/login');
        }
    }
}
