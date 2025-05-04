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

    // Halaman arsip laporan per hari
    public function arsipLaporanPerHari()
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

    // Halaman arsip laporan per bulan
    public function arsipLaporanPerBulan()
    {
        $data['judul'] = 'Arsip Laporan Penjualan PerBulan';
        $laporan = $this->laporanModel->where('kategori', 'perbulan')->findAll();
    
        // Array untuk mengubah angka bulan menjadi nama bulan
        $bulanMap = [
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
            '11' => 'Novyta m',
            '12' => 'Desember',
        ];
    
        // Gantilah bulan yang disimpan di database menjadi nama bulan
        foreach ($laporan as &$item) {
            if (isset($bulanMap[$item['bulan']])) {
                $item['bulan'] = $bulanMap[$item['bulan']];
            }
        }
    
        $data['laporan'] = $laporan;
    
        return view('admin/arsip_laporan/arsip_laporan_perbulan', $data);
    }
    

    public function downloadLaporanPerHari($id)
    {
        // Ambil data laporan dari database berdasarkan id
        $laporan = $this->laporanModel->find($id);

        if (!$laporan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Laporan dengan ID $id tidak ditemukan.");
        }

        $filename = $laporan['file_laporan'];
        $path = FCPATH . 'laporan/' . $filename;

        // Cek apakah file ada
        if (file_exists($path)) {
            // Ambil isi file
            $fileContent = file_get_contents($path);

            // Kirim file ke browser untuk diunduh
            return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
                ->setBody($fileContent);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("File laporan tidak ditemukan: $filename");
        }
    }

    public function downloadLaporanPerBulan($id)
    {
        // Ambil data laporan dari database berdasarkan id
        $laporan = $this->laporanModel->find($id);

        if (!$laporan) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Laporan dengan ID $id tidak ditemukan.");
        }

        $filename = $laporan['file_laporan'];
        $path = FCPATH . 'laporan/' . $filename;

        // Cek apakah file ada
        if (file_exists($path)) {
            // Ambil isi file
            $fileContent = file_get_contents($path);

            // Kirim file ke browser untuk diunduh
            return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'attachment; filename="' . $filename . '"')
                ->setBody($fileContent);
        } else {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("File laporan tidak ditemukan: $filename");
        }
    }
}
