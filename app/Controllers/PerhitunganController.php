<?php

namespace App\Controllers;

use App\Models\PerhitunganModel;
use App\Models\ProdukModel;
use App\Models\LaporanModel;

class PerhitunganController extends BaseController
{
    // Menampilkan Halaman Perhitungan
    public function index()
    {
        $perhitunganModel = new PerhitunganModel();
        $produkModel = new ProdukModel();

        // Mengambil laporan perhitungan untuk bulan tertentu
        $bulan = '2025-05'; // Misalnya bulan Mei 2025
        $data['laporan'] = $perhitunganModel->getLaporanBulanan($bulan);

        // Ambil data produk untuk dropdown di modal
        $data['produk'] = $produkModel->findAll();

        // Menambahkan variabel judul
        $data['judul'] = 'Laporan Perhitungan';

        return view('admin/perhitungan', $data);
    }

    // Menyimpan Perhitungan Harian
    public function store()
    {
        $perhitunganModel = new PerhitunganModel();
        $laporanModel = new LaporanModel(); // Menggunakan LaporanModel untuk mengambil total penjualan

        $id_produk = $this->request->getPost('id_produk');
        $tanggal = $this->request->getPost('tanggal');
        $modal = $this->request->getPost('modal');

        // Validasi id_produk
        $produkModel = new ProdukModel();
        $produk = $produkModel->find($id_produk);

        if (!$produk) {
            session()->setFlashdata('error', 'Produk tidak ditemukan.');
            return redirect()->to('/perhitungan');
        }

        // Ambil total penjualan (pendapatan) per hari berdasarkan tanggal
        $pendapatan = $laporanModel->getTotalPenjualanByDate($tanggal);

        // Hitung keuntungan
        $keuntungan = $pendapatan - $modal;

        $data = [
            'id_produk'  => $id_produk,
            'tanggal'    => $tanggal,
            'pendapatan' => $pendapatan,
            'modal'      => $modal,
            'keuntungan' => $keuntungan,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Simpan data ke tabel perhitungan
        if ($perhitunganModel->insert($data)) {
            session()->setFlashdata('pesan', 'Perhitungan berhasil disimpan!');
            return redirect()->to('/perhitungan'); // Redirect ke halaman perhitungan setelah berhasil menyimpan
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan perhitungan.');
            return redirect()->to('/perhitungan');
        }
    }

    // Update Perhitungan
    public function update()
    {
        $id = $this->request->getPost('id_perhitungan');
        $perhitunganModel = new PerhitunganModel();
        $laporanModel = new LaporanModel(); // Menggunakan LaporanModel untuk mengambil total penjualan

        // Ambil data dari form
        $id_produk = $this->request->getPost('id_produk');
        $tanggal = $this->request->getPost('tanggal');
        $modal = $this->request->getPost('modal');

        // Validasi id_produk
        $produkModel = new ProdukModel();
        $produk = $produkModel->find($id_produk);

        if (!$produk) {
            session()->setFlashdata('error', 'Produk tidak ditemukan.');
            return redirect()->to('/perhitungan');
        }

        // Ambil total penjualan (pendapatan) berdasarkan tanggal
        $pendapatan = $laporanModel->getTotalPenjualanByDate($tanggal);

        // Hitung keuntungan
        $keuntungan = $pendapatan - $modal;

        $data = [
            'id_produk'  => $id_produk,
            'pendapatan' => $pendapatan,
            'modal'      => $modal,
            'keuntungan' => $keuntungan,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($perhitunganModel->update($id, $data)) {
            session()->setFlashdata('pesan', 'Perhitungan berhasil diperbarui!');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui perhitungan.');
        }

        return redirect()->to('/perhitungan'); // Redirect ke halaman perhitungan setelah berhasil memperbarui
    }

    // Menghapus Perhitungan
    public function delete($id)
    {
        $perhitunganModel = new PerhitunganModel();

        if ($perhitunganModel->delete($id)) {
            session()->setFlashdata('pesan', 'Perhitungan berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus perhitungan.');
        }

        return redirect()->to('/perhitungan'); // Redirect ke halaman perhitungan setelah menghapus
    }

    // Mengambil Pendapatan berdasarkan Tanggal
    public function getPendapatan($tanggal)
    {
        $laporanModel = new LaporanModel();

        // Ambil total penjualan untuk tanggal tertentu
        $pendapatan = $laporanModel->getTotalPenjualanByDate($tanggal);

        // Kirimkan pendapatan sebagai respon JSON
        return $this->response->setJSON(['pendapatan' => $pendapatan]);
    }
}
