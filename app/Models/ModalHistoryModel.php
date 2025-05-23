<?php

namespace App\Models;

use CodeIgniter\Model;

class ModalHistoryModel extends Model
{
    protected $table      = 'modal_history';
    protected $primaryKey = 'id_modal';
    protected $allowedFields = ['tanggal', 'modal', 'created_at', 'updated_at'];
}
