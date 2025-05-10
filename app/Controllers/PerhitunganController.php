<?php

namespace App\Controllers;

use App\Models\PerhitunganModel;
use App\Models\ProdukModel;
use App\Models\LaporanModel;
use App\Models\ProdukTerjualModel;

class PerhitunganController extends BaseController
{
    // Menampilkan Halaman Perhitungan
    public function perhitungan_perhari()
    {
        $perhitunganModel = new PerhitunganModel();
        $produkModel = new ProdukModel();
        $produkTerjualModel = new ProdukTerjualModel();

        // Ambil tanggal dari input user, atau default ke hari ini
        $tanggal = $this->request->getGet('tanggal') ?? date('Y-m-d');

        // Ambil data produk terjual berdasarkan tanggal yang dipilih
        $data['produk_terjual'] = $produkTerjualModel
            ->where("DATE(created_at)", $tanggal)
            ->findAll();

        // Hitung total harga
        $totalHarga = 0;
        foreach ($data['produk_terjual'] as $produk_terjual) {
            $totalHarga += (int) str_replace(['.', ','], '', $produk_terjual['total_harga']);
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
    public function store_perhari()
    {
        $perhitunganModel = new PerhitunganModel();
        $laporanModel = new LaporanModel(); // Menggunakan LaporanModel untuk mengambil total penjualan
        $produkTerjualModel = new ProdukTerjualModel();

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

        // Ambil data produk terjual berdasarkan tanggal yang dipilih
        $data['produk_terjual'] = $produkTerjualModel
            ->where("DATE(created_at)", $tanggal)
            ->findAll();

        // Hitung total harga
        $totalHarga = 0;
        foreach ($data['produk_terjual'] as $produk_terjual) {
            $totalHarga += (int) str_replace(['.', ','], '', $produk_terjual['total_harga']);
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
            session()->setFlashdata('pesan', 'Perhitungan berhasil ditambahkan!');
            return redirect()->to('admin/perhitungan_perhari'); // Redirect ke halaman perhitungan setelah berhasil menyimpan
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan perhitungan.');
            return redirect()->to('admin/perhitungan_perhari');
        }
    }

    // Update Perhitungan
    public function update_perhari()
    {
        $id = $this->request->getPost('id_perhitungan');
        $perhitunganModel = new PerhitunganModel();
        $produkTerjualModel = new ProdukTerjualModel();

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

        // Ambil data produk terjual berdasarkan tanggal
        $produkTerjualList = $produkTerjualModel
            ->where("DATE(created_at)", $tanggal)
            ->findAll();

        // Hitung total harga dari produk terjual yang ditemukan
        $totalHarga = 0;
        foreach ($produkTerjualList as $produk_terjual) {
            $totalHarga += (int) str_replace(['.', ','], '', $produk_terjual['total_harga']);
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
    public function delete_perhari($id)
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
        $produkTerjualModel = new ProdukTerjualModel();

        // Ambil data produk terjual berdasarkan bulan dan tahun yang dipilih
        $produkTerjual = $produkTerjualModel
            ->select('produk_terjual.id_produk_terjual, produk.nama_produk, produk.harga, SUM(rincian_produk_terjual.jumlah) as total_jumlah, SUM(rincian_produk_terjual.total_harga) as total_pendapatan')
            ->join('rincian_produk_terjual', 'rincian_produk_terjual.id_produk_terjual = produk_terjual.id_produk_terjual')
            ->join('produk', 'produk.id_produk = rincian_produk_terjual.id_produk')
            ->where("MONTH(produk_terjual.created_at)", $bulan)  // Filter berdasarkan bulan
            ->where("YEAR(produk_terjual.created_at)", $tahun)  // Filter berdasarkan tahun
            ->groupBy('rincian_produk_terjual.id_produk, produk.nama_produk, produk.harga')
            ->orderBy('produk.nama_produk', 'ASC')
            ->findAll();

        $data['produk_terjual'] = $produkTerjual;
        $data['total_harga'] = array_sum(array_column($produkTerjual, 'total_pendapatan'));

        // Data lainnya
        $data['produk'] = $produkModel->findAll();
        $data['laporan'] = $perhitunganModel->where('type', 'perbulan')->findAll();
        $data['judul'] = 'Perhitungan Perbulan';
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['listBulan'] = $listBulan;
        $data['listTahun'] = $listTahun;

        return view('admin/perhitungan/perhitungan_perbulan', $data);
    }

    public function store_perbulan()
    {
        $perhitunganModel = new PerhitunganModel();
        $produkTerjualModel = new ProdukTerjualModel();

        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');
        $modal = $this->request->getPost('modal');

        // Format tanggal awal dan akhir dari bulan yang dipilih
        $tanggalAwal = date("$tahun-$bulan-01");
        $tanggalAkhir = date("Y-m-t", strtotime($tanggalAwal)); // t = last day of the month

        // Ambil data produk terjual dari tanggal awal sampai akhir bulan
        $produkTerjual = $produkTerjualModel
            ->where('DATE(created_at) >=', $tanggalAwal)
            ->where('DATE(created_at) <=', $tanggalAkhir)
            ->findAll();

        // Hitung total pendapatan
        $totalPendapatan = 0;
        foreach ($produkTerjual as $produk) {
            $totalPendapatan += (int) str_replace(['.', ','], '', $produk['total_harga']);
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
            session()->setFlashdata('pesan', 'Perhitungan bulanan berhasil ditambahkan!');
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan perhitungan bulanan.');
        }

        return redirect()->to('admin/perhitungan_perbulan');
    }

    public function update_perbulan()
    {
        $id = $this->request->getPost('id_perhitungan');
        $perhitunganModel = new PerhitunganModel();
        $produkTerjualModel = new ProdukTerjualModel();

        $dataPerhitungan = $perhitunganModel->find($id);

        // Ambil data dari form
        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');
        $modal = $this->request->getPost('modal');

        // Format tanggal awal dan akhir dari bulan yang dipilih
        $tanggalAwal = date("$tahun-$bulan-01");
        $tanggalAkhir = date("Y-m-t", strtotime($tanggalAwal)); // t = last day of the month

        // Ambil data produk terjual dari tanggal awal sampai akhir bulan
        $produkTerjual = $produkTerjualModel
            ->where('DATE(created_at) >=', $tanggalAwal)
            ->where('DATE(created_at) <=', $tanggalAkhir)
            ->findAll();

        // Hitung total pendapatan
        $totalPendapatan = 0;
        foreach ($produkTerjual as $produk) {
            $totalPendapatan += (int) str_replace(['.', ','], '', $produk['total_harga']);
        }

        // Hitung keuntungan
        $keuntungan = $totalPendapatan - $modal;

        $data = [
            'pendapatan' => $totalPendapatan,
            'modal'      => $modal,
            'keuntungan' => $keuntungan,
            'tanggal'    => $tanggalAwal,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

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
            session()->setFlashdata('pesan', 'Perhitungan bulanan berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus perhitungan bulanan.');
        }

        return redirect()->to('admin/perhitungan_perbulan'); // Redirect ke halaman perhitungan bulanan setelah menghapus
    }
}
