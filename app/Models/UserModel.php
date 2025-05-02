<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['username', 'email', 'password', 'level', 'created_at', 'updated_at'];

    // Validation rules
    protected $validationRules = [
        'username' => 'required|min_length[3]|max_length[100]',
        'email' => 'required|valid_email|is_unique[user.email]',
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
