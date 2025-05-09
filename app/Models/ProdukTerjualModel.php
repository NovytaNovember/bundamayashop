<?php

namespace App\Models;

use CodeIgniter\Model;

class ProdukTerjualModel extends Model
{
    protected $table      = 'produk_terjual';
    protected $primaryKey = 'id_produk_terjual';

    protected $allowedFields = ['total_harga'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
