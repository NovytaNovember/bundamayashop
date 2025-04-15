<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'penjualan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tanggal_penjualan', 'nama_produk', 'jumlah_terjual', 'harga', 'total_penjualan'];

    public function getPenjualanByDateRange($tanggal_awal, $tanggal_akhir)
    {
        return $this->where('tanggal_penjualan >=', $tanggal_awal)
                    ->where('tanggal_penjualan <=', $tanggal_akhir)
                    ->findAll();
    }
}