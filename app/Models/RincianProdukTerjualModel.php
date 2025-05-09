<?php

namespace App\Models;

use CodeIgniter\Model;

class RincianProdukTerjualModel extends Model
{
    protected $table      = 'rincian_produk_terjual';
    protected $primaryKey = 'id_rincian_produk_terjual';

    protected $allowedFields = ['id_produk_terjual', 'id_produk', 'jumlah', 'total_harga'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
