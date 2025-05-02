<?php

namespace App\Models;

use CodeIgniter\Model;

class PerhitunganModel extends Model
{
    protected $table      = 'perhitungan';
    protected $primaryKey = 'id_perhitungan';
    protected $allowedFields = ['id_produk', 'tanggal', 'pendapatan', 'modal', 'keuntungan', 'created_at', 'updated_at'];

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
        return $this->select('perhitungan.*, produk.nama_produk') // Mengambil nama produk
                    ->join('produk', 'produk.id_produk = perhitungan.id_produk') // Melakukan join dengan tabel produk
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
