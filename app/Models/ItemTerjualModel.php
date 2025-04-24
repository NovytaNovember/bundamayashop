<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemTerjualModel extends Model
{
    protected $table      = 'item_terjual';
    protected $primaryKey = 'id_item_terjual';

    protected $allowedFields = ['id_item_terjual', 'id_produk', 'jumlah', 'total_harga'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
