<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemModel extends Model
{
    protected $table      = 'order_item';
    protected $primaryKey = 'id_order_item';

    protected $allowedFields = ['id_order', 'id_produk', 'jumlah', 'total_harga'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
