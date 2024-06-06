<?php

namespace App\Models;

use CodeIgniter\Model;

class M_tenaga_pendidik extends Model
{
    protected $table = 'tendik';
    protected $primaryKey  = 'id_tendik';
    // protected $allowedFields = ['username', 'password'];

    public function getTendik($id = FALSE)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id_tendik' => $id]);
    }
}
