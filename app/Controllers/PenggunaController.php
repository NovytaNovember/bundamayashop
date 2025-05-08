<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class PenggunaController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();

        // Fetch all users
        $data = [
            'judul' => 'Data Pengguna',
            'users' => $userModel->findAll(),
        ];

        return view('admin/pengguna', $data);
    }

    public function store()
    {
        $userModel = new UserModel();

        $data = [
            'username'  => $this->request->getPost('username'),
            'email'     => $this->request->getPost('email'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'level'     => $this->request->getPost('level'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        // $userAdmin = $userModel->where('level', 'admin')->first();
        
        // if ($userAdmin) {
        //     return redirect()->to('/admin/user')->with('error', 'Tidak dapat menambahkan user admin.');
        // }


        if ($userModel->insert($data)) {
            session()->setFlashdata('pesan', 'Data pengguna berhasil ditambahkan!');
        } else {
            session()->setFlashdata('error', 'Gagal menambahkan data pengguna.');
        }

        return redirect()->to('/admin/pengguna');
    }

    public function edit($id)
    {
        $userModel = new UserModel();

        // Fetch user data by ID
        $user = $userModel->find($id);

        if ($user) {
            $data = [
                'judul' => 'Edit User',
                'user' => $user,
            ];

            return view('admin/pengguna_edit', $data);
        } else {
            return redirect()->to('/admin/pengguna')->with('error', 'Data pengguna tidak ditemukan.');
        }
    }

    public function update()
    {
        $userModel = new UserModel();

        $id = $this->request->getPost('id_user');
        $data = [
            'username'  => $this->request->getPost('username'),
            'email'     => $this->request->getPost('email'),
            'level'     => $this->request->getPost('level'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        if ($userModel->update($id, $data)) {
            session()->setFlashdata('pesan', 'Data pengguna berhasil diperbarui!');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui data pengguna.');
        }

        return redirect()->to('/admin/pengguna');
    }

    public function delete($id)
    {
        $userModel = new UserModel();

        if ($userModel->delete($id)) {
            session()->setFlashdata('pesan', 'Data pengguna berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data pengguna.');
        }

        return redirect()->to('/admin/pengguna');
    }
}
