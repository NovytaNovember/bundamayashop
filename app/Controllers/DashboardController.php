<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProdukModel;
use App\Models\KategoriModel;

class DashboardController extends BaseController
{
    public function index()
    {
        $produkModel = new ProdukModel();
        $kategoriModel = new KategoriModel();

        $totalProduk = $produkModel->countAll();
        $totalKategori = $kategoriModel->countAll();

        $data = [
            'judul' => 'Dashboard Admin',
            'totalProduk' => $totalProduk,
            'totalKategori' => $totalKategori,
        ];

        return view('admin/dashboard', $data);
    }
}
