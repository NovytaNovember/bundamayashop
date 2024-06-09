<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPendaftaran extends Model
{
    protected $table            = 'pendaftaran';
    protected $primaryKey       = 'id_pendaftaran';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_pendaftaran, id_akun, status, tahun, nama_calon peserta didik, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, nama_ayah, nama_ibu, pekerjaan_ayah, pekerjaan_ibu, no_telepon_ayah, no_telepon_ibu, agama'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getPendaftaran($id = FALSE)
    {
        if ($id == FALSE) {
            return $this->findAll();
        }

        return $this->where(['id_pendaftaran' => $id])->first();
    }
}