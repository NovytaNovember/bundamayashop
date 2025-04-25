<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingModel extends Model
{
    protected $table      = 'setting';
    protected $primaryKey = 'id_setting';

    protected $allowedFields = [
        'nama_toko', 'alamat', 'no_hp', 'email', 'jam_operasional', 'logo', 'created_at', 'updated_at'
    ];
}
