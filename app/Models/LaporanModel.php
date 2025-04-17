<?php

namespace App\Models;

use CodeIgniter\Model;

class LaporanModel extends Model
{
    protected $table = 'laporan';
    protected $primaryKey = 'id_laporan';
    protected $allowedFields = ['file_laporan', 'bulan', 'tahun', 'kategori', 'total_penjualan_bulanan', 'created_at', 'updated_at'];
}
