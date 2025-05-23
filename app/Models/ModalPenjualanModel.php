<?php

namespace App\Models;

use CodeIgniter\Model;

class ModalPenjualanModel extends Model
{
    protected $table      = 'modal_penjualan';
    protected $primaryKey = 'id_modal';
    protected $allowedFields = ['tanggal', 'modal', 'created_at', 'updated_at'];
}
