<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model
{
    protected $table = 'pengguna'; // Mengubah nama tabel menjadi pengguna
    protected $primaryKey = 'id_pengguna'; // Mengubah nama primary key menjadi id_pengguna
    protected $allowedFields = ['username', 'email', 'password', 'level', 'created_at', 'updated_at'];

    // Validation rules
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|is_unique[pengguna.email]', // Mengubah nama tabel menjadi pengguna
        'password' => 'required|min_length[6]',
        'level' => 'required|in_list[admin,petugas,owner]',
    ];

    // Custom error messages
    protected $validationMessages = [
        'email' => [
            'is_unique' => 'Email sudah terdaftar.',
        ],
    ];
}
