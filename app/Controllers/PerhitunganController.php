<?php

namespace App\Controllers;

use App\Models\PerhitunganModel;
use App\Models\ProdukModel;
use App\Models\ProdukTerjualModel;
use App\Models\ModalHistoryModel;

class PerhitunganController extends BaseController
{
    // Menampilkan Halaman Modal (Perhitungan Perhari)
    // Di dalam Controller

    public function modal_perhitungan()
    {
        $perhitunganModel = new PerhitunganModel();
        $produkModel = new ProdukModel();
        $produkTerjualModel = new ProdukTerjualModel();
        $modalHistoryModel = new ModalHistoryModel(); // Model untuk histori modal

        // Ambil tanggal dari input user, atau default ke hari ini
        $tanggal = $this->request->getGet('tanggal') ?? date('Y-m-d');

        // Mengatur locale untuk bahasa Indonesia
        setlocale(LC_TIME, 'id_ID', 'id_ID.utf8', 'indonesia');

        // Format tanggal dengan strftime
        $data['tanggal_terpilih'] = strftime('%A, %d %B %Y', strtotime($tanggal)); // Format "Rabu, 21 Mei 2025"

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

        // Ambil history modal
        $data['modal_history'] = $modalHistoryModel->orderBy('created_at', 'DESC')->findAll(); // Ambil semua histori modal yang terbaru

        // Data lainnya
        $data['produk'] = $produkModel->findAll();
        $data['judul'] = 'Modal Penjualan';
        $data['tanggal_terpilih'] = $data['tanggal_terpilih'];  // Tanggal yang sudah diformat

        return view('admin/perhitungan/modal_perhitungan', $data);
    }

    // Menyimpan History Modal
    public function store_modal()
    {
        $modalHistoryModel = new ModalHistoryModel();

        $modal = $this->request->getPost('modal');
        $tanggal = $this->request->getPost('tanggal');

        // Validasi modal
        if (!$modal) {
            session()->setFlashdata('error', 'Modal tidak boleh kosong.');
            return redirect()->to('admin/modal_perhitungan');
        }

        // Simpan history modal
        $data = [
            'tanggal'   => $tanggal,
            'modal'     => $modal,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // Simpan data modal
        if ($modalHistoryModel->insert($data)) {
            session()->setFlashdata('pesan', 'History modal penjualan berhasil ditambahkan!');
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan history modal penjualan.');
        }

        return redirect()->to('admin/modal_perhitungan');
    }

    // Update Modal
    public function update_modal()
    {
        $id = $this->request->getPost('id_modal');
        $modalHistoryModel = new ModalHistoryModel();

        $dataModal = $modalHistoryModel->find($id);

        // Ambil data dari form
        $modal = $this->request->getPost('modal');
        $tanggal = $this->request->getPost('tanggal');

        $data = [
            'modal' => $modal,
            'tanggal' => $tanggal,
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($modalHistoryModel->update($id, $data)) {
            session()->setFlashdata('pesan', 'History modal penjualan berhasil diperbarui!');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui history modal penjualan.');
        }

        return redirect()->to('admin/modal_perhitungan');
    }

    // Menghapus Modal
    public function delete_modal($id)
    {
        $modalHistoryModel = new ModalHistoryModel();

        if ($modalHistoryModel->delete($id)) {
            session()->setFlashdata('pesan', 'History modal penjualan berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus history modal penjualan.');
        }

        return redirect()->to('admin/modal_perhitungan');
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
        $modalHistoryModel = new ModalHistoryModel();

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

        // Ambil semua modal history
        $data['modal_history'] = $modalHistoryModel->findAll(); // Ambil semua histori modal

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
        $modalHistoryModel = new ModalHistoryModel();

        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');
        $selectedModal = $this->request->getPost('modal'); // Ambil modal yang dipilih dari form

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

        // Ambil modal yang dipilih
        $modal = $modalHistoryModel->find($selectedModal); // Ambil modal yang dipilih dari modal history

        // Hitung keuntungan
        $keuntungan = $totalPendapatan - $modal['modal'];

        $data = [
            'tanggal'    => $tanggalAwal, // disimpan sebagai awal bulan
            'pendapatan' => $totalPendapatan,
            'modal'      => $modal['modal'], // Gunakan modal yang dipilih
            'keuntungan' => $keuntungan,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'type'       => 'perbulan' // bedakan jenis perhitungan
        ];

        if ($perhitunganModel->insert($data)) {
            session()->setFlashdata('pesan', 'Perhitungan perbulan berhasil ditambahkan!');
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan perhitungan bulanan.');
        }

        return redirect()->to('admin/perhitungan_perbulan');
    }

   public function update_perbulan()
{
    $id_perhitungan = $this->request->getPost('id_perhitungan');
    $bulan = $this->request->getPost('bulan');
    $tahun = $this->request->getPost('tahun');
    $modal = $this->request->getPost('modal');

    // Format tanggal awal dan akhir dari bulan yang dipilih
    $tanggalAwal = date("$tahun-$bulan-01");
    $tanggalAkhir = date("Y-m-t", strtotime($tanggalAwal)); // t = last day of the month

    $produkTerjualModel = new ProdukTerjualModel();
    $totalPendapatan = 0;
    // Ambil data produk terjual dari tanggal awal sampai akhir bulan
    $produkTerjual = $produkTerjualModel
        ->where('DATE(created_at) >=', $tanggalAwal)
        ->where('DATE(created_at) <=', $tanggalAkhir)
        ->findAll();

    foreach ($produkTerjual as $produk) {
        $totalPendapatan += (int) str_replace(['.', ','], '', $produk['total_harga']);
    }

    // Ambil modal yang dipilih
    $modalHistoryModel = new ModalHistoryModel();
    $modalData = $modalHistoryModel->find($modal);

    // Hitung keuntungan
    $keuntungan = $totalPendapatan - $modalData['modal'];

    $data = [
        'tanggal'    => $tanggalAwal,
        'pendapatan' => $totalPendapatan,
        'modal'      => $modalData['modal'],
        'keuntungan' => $keuntungan,
        'updated_at' => date('Y-m-d H:i:s'),
    ];

    $perhitunganModel = new PerhitunganModel();
    if ($perhitunganModel->update($id_perhitungan, $data)) {
        session()->setFlashdata('pesan', 'Perhitungan perbulan berhasil diperbarui!');
    } else {
        session()->setFlashdata('error', 'Gagal memperbarui perhitungan bulanan.');
    }

    return redirect()->to('admin/perhitungan_perbulan');
}


public function delete_perbulan($id)
{
    $perhitunganModel = new PerhitunganModel();

    if ($perhitunganModel->delete($id)) {
        session()->setFlashdata('pesan', 'Perhitungan perbulan berhasil dihapus');
    } else {
        session()->setFlashdata('error', 'Gagal menghapus perhitungan');
    }

    return redirect()->to('admin/perhitungan_perbulan');
}

}

