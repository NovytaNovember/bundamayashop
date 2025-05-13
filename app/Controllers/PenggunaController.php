<?php

namespace App\Controllers;

use App\Models\PenggunaModel;
use CodeIgniter\Controller;

class PenggunaController extends BaseController
{
    public function index()
    {
        $penggunaModel = new PenggunaModel();

        // Fetch all users
        $data = [
            'judul' => 'Data Pengguna',
            'pengguna' => $penggunaModel->findAll(),
        ];

        return view('admin/pengguna', $data);
    }

    public function store()
{
    $penggunaModel = new PenggunaModel();

    $data = [
        'username'  => $this->request->getPost('username'),
        'email'     => $this->request->getPost('email'),
        'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),  // Menggunakan bcrypt secara default
        'level'     => $this->request->getPost('level'),
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s'),
    ];

    if ($penggunaModel->insert($data)) {
        session()->setFlashdata('pesan', 'Data pengguna berhasil ditambahkan!');
    } else {
        session()->setFlashdata('error', 'Gagal menambahkan data pengguna.');
    }

    return redirect()->to('/admin/pengguna');
}


    public function edit($id)
    {
        $penggunaModel = new PenggunaModel();

        // Fetch user data by ID
        $pengguna = $penggunaModel->find($id);

        if ($pengguna) {
            $data = [
                'judul' => 'Edit Pengguna',
                'pengguna' => $pengguna,
            ];

            return view('admin/pengguna_edit', $data);
        } else {
            return redirect()->to('/admin/pengguna')->with('error', 'Data pengguna tidak ditemukan.');
        }
    }

    public function update()
    {
        $penggunaModel = new PenggunaModel();

        $id = $this->request->getPost('id_pengguna');
        $data = [
            'username'  => $this->request->getPost('username'),
            'email'     => $this->request->getPost('email'),
            'level'     => $this->request->getPost('level'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        if ($penggunaModel->update($id, $data)) {
            session()->setFlashdata('pesan', 'Data pengguna berhasil diperbarui!');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui data pengguna.');
        }

        return redirect()->to('/admin/pengguna');
    }

    public function delete($id)
    {
        $penggunaModel = new PenggunaModel();

        if ($penggunaModel->delete($id)) {
            session()->setFlashdata('pesan', 'Data pengguna berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data pengguna.');
        }

        return redirect()->to('/admin/pengguna');
    }
}
