<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';
    protected $allowedFields = ['file_laporan', 'bulan', 'tahun', 'kategori', 'total_penjualan', 'created_at', 'updated_at'];

    // Mengambil total penjualan per hari berdasarkan created_at
    public function getTotalPenjualanByDate($tanggal)
    {
        return $this->where("DATE(created_at)", $tanggal) // Menggunakan DATE() untuk hanya mengambil tanggal
                    ->selectSum('total_penjualan') // Menghitung total penjualan
                    ->first()['total_penjualan'] ?? 0; // Jika tidak ada data, return 0
    }

    // Mengambil total penjualan per bulan berdasarkan bulan dan tahun dari created_at
    public function getTotalPenjualanByMonth($bulan, $tahun)
    {
        return $this->where("MONTH(created_at)", $bulan) // Mengambil berdasarkan bulan
                    ->where("YEAR(created_at)", $tahun) // Mengambil berdasarkan tahun
                    ->selectSum('total_penjualan') // Menghitung total penjualan
                    ->first()['total_penjualan'] ?? 0; // Jika tidak ada data, return 0
    }
}
