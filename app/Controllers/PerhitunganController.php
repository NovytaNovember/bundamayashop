<?php

namespace App\Controllers;

use App\Models\PerhitunganModel;
use App\Models\ProdukModel;
use App\Models\LaporanModel;
use App\Models\OrderModel;

class PerhitunganController extends BaseController
{
    // Menampilkan Halaman Perhitungan
    public function perhitungan_perhari()
    {
        $perhitunganModel = new PerhitunganModel();
        $produkModel = new ProdukModel();
        $orderModel = new OrderModel();

        // Ambil tanggal dari input user, atau default ke hari ini
        $tanggal = $this->request->getGet('tanggal') ?? date('Y-m-d');

        // Ambil data order berdasarkan tanggal yang dipilih
        $data['order'] = $orderModel
            ->where("DATE(created_at)", $tanggal)
            ->findAll();

        // Hitung total harga
        $totalHarga = 0;
        foreach ($data['order'] as $order) {
            $totalHarga += (int) str_replace(['.', ','], '', $order['total_harga']);
        }

        $data['total_harga'] = $totalHarga;

        // Data lainnya
        $data['produk'] = $produkModel->findAll();
        $data['laporan'] = $perhitunganModel->where('type', 'perhari')->getLaporanBulanan('2025-05');
        $data['judul'] = 'Perhitungan Perhari';
        $data['tanggal_terpilih'] = $tanggal;

        return view('admin/perhitungan/perhitungan_perhari', $data);
    }


    // Menyimpan Perhitungan Harian
    public function store()
    {
        $perhitunganModel = new PerhitunganModel();
        $laporanModel = new LaporanModel(); // Menggunakan LaporanModel untuk mengambil total penjualan
        $orderModel = new OrderModel();

        $id_produk = $this->request->getPost('id_produk');
        $tanggal = $this->request->getPost('tanggal');
        $modal = $this->request->getPost('modal');

        // Validasi id_produk
        $produkModel = new ProdukModel();
        $produk = $produkModel->find($id_produk);

        if (!$produk) {
            session()->setFlashdata('error', 'Produk tidak ditemukan.');
            return redirect()->to('admin/perhitungan_perhari');
        }

        // Ambil data order berdasarkan tanggal yang dipilih
        $data['order'] = $orderModel
            ->where("DATE(created_at)", $tanggal)
            ->findAll();

        // Hitung total harga
        $totalHarga = 0;
        foreach ($data['order'] as $order) {
            $totalHarga += (int) str_replace(['.', ','], '', $order['total_harga']);
        }

        $data['total_harga'] = $totalHarga;

        // Hitung keuntungan
        $keuntungan =  $data['total_harga'] - $modal; //Perhitungan modal - pendapatan dihari ini = keuntungan


        $data = [
            'id_produk'  => $id_produk,
            'tanggal'    => $tanggal,
            'pendapatan' => $data['total_harga'],
            'modal'      => $modal,
            'keuntungan' => $keuntungan,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'type'       => 'perhari'
        ];

        // Simpan data ke tabel perhitungan
        if ($perhitunganModel->insert($data)) {
            session()->setFlashdata('pesan', 'Perhitungan berhasil disimpan!');
            return redirect()->to('admin/perhitungan_perhari'); // Redirect ke halaman perhitungan setelah berhasil menyimpan
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan perhitungan.');
            return redirect()->to('admin/perhitungan_perhari');
        }
    }

    // Update Perhitungan
    public function update()
    {
        $id = $this->request->getPost('id_perhitungan');
        $perhitunganModel = new PerhitunganModel();
        $orderModel = new OrderModel();

        $dataPerhitungan = $perhitunganModel->find($id);

        // Ambil data dari form
        $id_produk = $this->request->getPost('id_produk');
        $tanggal = $this->request->getPost('tanggal');
        $modal = $this->request->getPost('modal');

        // Validasi id_produk
        $produkModel = new ProdukModel();
        $produk = $produkModel->find($id_produk);

        if (!$produk) {
            session()->setFlashdata('error', 'Produk tidak ditemukan.');
            return redirect()->to('admin/perhitungan_perhari');
        }

        // Ambil data order berdasarkan tanggal
        $orderList = $orderModel
            ->where("DATE(created_at)", $tanggal)
            ->findAll();

        // Hitung total harga dari order yang ditemukan
        $totalHarga = 0;
        foreach ($orderList as $order) {
            $totalHarga += (int) str_replace(['.', ','], '', $order['total_harga']);
        }

        // Hitung keuntungan
        $keuntungan = $totalHarga - $modal;

        // Siapkan data untuk update
        $data = [
            'id_produk'  => $id_produk,
            'pendapatan' => $totalHarga,
            'modal'      => $modal,
            'keuntungan' => $keuntungan,
            'tanggal'    => $tanggal,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($perhitunganModel->update($id, $data)) {
            session()->setFlashdata('pesan', 'Perhitungan berhasil diperbarui!');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui perhitungan.');
        }

        return redirect()->to('admin/perhitungan_perhari');
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

        return redirect()->to('admin/perhitungan_perhari'); // Redirect ke halaman perhitungan setelah menghapus
    }

    public function perhitungan_perbulan($bulan = null, $tahun = null)
    {
        // Use default values for bulan and tahun if not set
        if (!$bulan || !$tahun) {
            $bulan = $this->request->getGet('bulan') ?? date('m');
            $tahun = $this->request->getGet('tahun') ?? date('Y');
        }

        // Define months and years in the controller
        $listBulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $currentYear = date('Y');
        $listTahun = [
            $currentYear - 1 => $currentYear - 1, // Last year
            $currentYear => $currentYear, // Current year
        ];
        $perhitunganModel = new PerhitunganModel();
        $produkModel = new ProdukModel();
        $orderModel = new OrderModel();

        // Ambil tanggal dari input user, atau default ke hari ini
        $tanggal = $this->request->getGet('tanggal') ?? date('Y-m-d');

        // Ambil data order berdasarkan tanggal yang dipilih
        $data['order'] = $orderModel
            ->where("DATE(created_at)", $tanggal)
            ->findAll();

        // Hitung total harga
        $totalHarga = 0;
        foreach ($data['order'] as $order) {
            $totalHarga += (int) str_replace(['.', ','], '', $order['total_harga']);
        }

        $data['total_harga'] = $totalHarga;

        // Data lainnya
        $data['produk'] = $produkModel->findAll();
        $data['laporan'] = $perhitunganModel->where('type', 'perbulan')->findAll();
        $data['judul'] = 'Perhitungan Perbulan';
        $data['tanggal_terpilih'] = $tanggal;
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['listBulan'] = $listBulan;
        $data['listTahun'] = $listTahun;

        return view('admin/perhitungan/perhitungan_perbulan', $data);
    }

    public function store_perbulan()
    {
        $perhitunganModel = new PerhitunganModel();
        $laporanModel = new LaporanModel();
        $orderModel = new OrderModel();

        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');
        $modal = $this->request->getPost('modal');

        // Format tanggal awal dan akhir dari bulan yang dipilih
        $tanggalAwal = date("$tahun-$bulan-01");
        $tanggalAkhir = date("Y-m-t", strtotime($tanggalAwal)); // t = last day of the month

        // Ambil data order dari tanggal awal sampai akhir bulan
        $orders = $orderModel
            ->where('DATE(created_at) >=', $tanggalAwal)
            ->where('DATE(created_at) <=', $tanggalAkhir)
            ->findAll();

        // Hitung total pendapatan
        $totalPendapatan = 0;
        foreach ($orders as $order) {
            $totalPendapatan += (int) str_replace(['.', ','], '', $order['total_harga']);
        }

        // Hitung keuntungan
        $keuntungan = $totalPendapatan - $modal;

        $data = [
            'tanggal'    => $tanggalAwal, // disimpan sebagai awal bulan
            'pendapatan' => $totalPendapatan,
            'modal'      => $modal,
            'keuntungan' => $keuntungan,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'type'       => 'perbulan' // bedakan jenis perhitungan
        ];

        if ($perhitunganModel->insert($data)) {
            session()->setFlashdata('pesan', 'Perhitungan bulanan berhasil disimpan!');
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan perhitungan bulanan.');
        }

        return redirect()->to('admin/perhitungan_perbulan');
    }


    public function update_perbulan()
    {
        $id = $this->request->getPost('id_perhitungan'); // Ambil ID perhitungan dari form
        $perhitunganModel = new PerhitunganModel();
        $orderModel = new OrderModel();

        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');
        $modal = $this->request->getPost('modal');

        // Format tanggal awal dan akhir bulan
        $tanggalAwal = date("$tahun-$bulan-01");
        $tanggalAkhir = date("Y-m-t", strtotime($tanggalAwal)); // t = last day of the month

        // Ambil semua data order dalam bulan tersebut
        $orders = $orderModel
            ->where('DATE(created_at) >=', $tanggalAwal)
            ->where('DATE(created_at) <=', $tanggalAkhir)
            ->findAll();

        // Hitung total pendapatan
        $totalPendapatan = 0;
        foreach ($orders as $order) {
            $totalPendapatan += (int) str_replace(['.', ','], '', $order['total_harga']);
        }

        // Hitung keuntungan
        $keuntungan = $totalPendapatan - $modal;

        // Siapkan data untuk update
        $data = [
            'tanggal'    => $tanggalAwal,
            'pendapatan' => $totalPendapatan,
            'modal'      => $modal,
            'keuntungan' => $keuntungan,
            'updated_at' => date('Y-m-d H:i:s'),
            'type'       => 'perbulan'
        ];

        // Simpan perubahan ke database
        if ($perhitunganModel->update($id, $data)) {
            session()->setFlashdata('pesan', 'Perhitungan bulanan berhasil diperbarui!');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui perhitungan bulanan.');
        }

        return redirect()->to('admin/perhitungan_perbulan');
    }

    public function delete_perbulan($id)
    {
        $perhitunganModel = new PerhitunganModel();

        if ($perhitunganModel->delete($id)) {
            session()->setFlashdata('pesan', 'Perhitungan berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus perhitungan.');
        }

        return redirect()->to('admin/perhitungan_perbulan'); // Redirect ke halaman perhitungan setelah menghapus
    }
}
