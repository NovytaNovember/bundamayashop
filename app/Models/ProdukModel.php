<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukModel extends Model
{
    protected $table      = 'produk';
    protected $primaryKey = 'id_produk';
    protected $allowedFields = ['nama_produk', 'deskripsi', 'id_kategori', 'harga','gambar','created_at', 'updated_at'];

    // Method untuk update produk
    public function updateProduk($id, $data)
    {
        return $this->update($id, $data); // Menyimpan perubahan data produk
    }
}