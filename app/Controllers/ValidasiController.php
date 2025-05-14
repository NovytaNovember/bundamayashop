<?php

namespace App\Controllers;

use App\Models\PenggunaModel;
use CodeIgniter\Controller;

class ValidasiController extends Controller
{
    public function login()
    {
        return view('login'); // Menampilkan halaman login
    }

   public function authenticate()
{
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');

    // Validasi input
    if (!$username || !$password) {
        return redirect()->back()->with('pesan', 'Username dan password harus diisi');
    }

    // Cek apakah pengguna ada di database
    $penggunaModel = new PenggunaModel();
    $user = $penggunaModel->getUserByUsername($username);
// dd($user);
    if ($user) {
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            // Set session berdasarkan level
            session()->set([
                'id_pengguna' => $user['id_pengguna'],
                'username' => $user['username'],
                'level' => $user['level'], // admin, owner, petugas
            ]);

            // Redirect ke dashboard sesuai level
            switch ($user['level']) {
                case 'admin':
                    return redirect()->to('/admin/dashboard');
                case 'owner':
                    return redirect()->to('/owner/dashboard');
                case 'petugas':
                    return redirect()->to('/petugas/dashboard');
                default:
                    return redirect()->to('/login'); // Kembali ke login jika level tidak valid
            }
        } else {
            session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">Password salah</div>');
            return redirect()->to('/login')->withInput();
        }
    } else {
        session()->setFlashdata('pesan', '<div class="alert alert-danger" role="alert">Username tidak ditemukan</div>');
        return redirect()->to('/login')->withInput();
    }
}



    public function logout()
    {
        session()->destroy(); // Hapus session
        return redirect()->to('/login'); // Kembali ke halaman login
    }
}
