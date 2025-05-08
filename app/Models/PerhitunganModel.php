<?php

namespace App\Models;

use CodeIgniter\Model;

class PerhitunganModel extends Model
{
    protected $table      = 'perhitungan';
    protected $primaryKey = 'id_perhitungan';
    protected $allowedFields = ['pendapatan_hari_ini', 'tanggal', 'pendapatan', 'modal', 'keuntungan', 'created_at', 'updated_at', 'type'];

    // Relasi dengan Produk
    public function produk()
    {
        return $this->belongsTo(ProdukModel::class, 'id_produk');
    }

    // Menyimpan data perhitungan
    public function createPerhitungan($data)
    {
        return $this->insert($data);
    }

    // Mendapatkan laporan perhitungan bulanan dengan join ke produk
    public function getLaporanBulanan($bulan)
    {
        return $this // Mengambil nama produk

            ->where('tanggal >=', $bulan . '-01')
            ->where('tanggal <=', $bulan . '-31')
            ->findAll();
    }

    // Update perhitungan
    public function updatePerhitungan($id_perhitungan, $data)
    {
        return $this->update($id_perhitungan, $data);
    }
}
