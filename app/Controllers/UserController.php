<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class UserController extends BaseController
{
    public function index()
    {
        $userModel = new UserModel();
        
        // Fetch all users
        $data = [
            'judul' => 'Data User',
            'users' => $userModel->findAll(),
        ];

        return view('admin/user', $data);
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

        if ($userModel->insert($data)) {
            session()->setFlashdata('pesan', 'User berhasil ditambahkan!');
        } else {
            session()->setFlashdata('error', 'Gagal menambahkan user.');
        }

        return redirect()->to('/admin/user');
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

            return view('admin/user_edit', $data);
        } else {
            return redirect()->to('/admin/user')->with('error', 'User tidak ditemukan.');
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
            session()->setFlashdata('pesan', 'User berhasil diperbarui!');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui user.');
        }

        return redirect()->to('/admin/user');
    }

    public function delete($id)
    {
        $userModel = new UserModel();

        if ($userModel->delete($id)) {
            session()->setFlashdata('pesan', 'User berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus user.');
        }

        return redirect()->to('/admin/user');
    }
}
