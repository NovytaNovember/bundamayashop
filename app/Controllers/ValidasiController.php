<?php

namespace App\Controllers;

use App\Models\PenggunaModel;
use CodeIgniter\Controller;

class ValidasiController extends Controller
{
    public function login()
    {
        // Menampilkan halaman login
        return view('login');
    }

    public function authenticate()
    {
        $session = session();
        $model = new PenggunaModel();

        // Mendapatkan inputan pengguna
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validasi data login
        $user = $model->where('username', $username)->first();

        // Cek jika user ditemukan dan password cocok
   if ($user && password_verify($password, $user['password'])) {
    // Set session dengan data pengguna
    $session->set([
        'id_pengguna' => $user['id_pengguna'],
        'username' => $user['username'],
        'level' => $user['level'],
        'is_logged_in' => true
    ]);

    // Debugging: Cek session setelah diset
    echo '<pre>';
    print_r($session->get());  // Debugging session yang telah diset
    echo '</pre>';

    // Redirect berdasarkan level pengguna
    if ($user['level'] == 'admin') {
        return redirect()->to('/admin/dashboard'); // Dashboard admin
    } elseif ($user['level'] == 'petugas') {
        return redirect()->to('/petugas/dashboard'); // Dashboard petugas
    } elseif ($user['level'] == 'owner') {
        return redirect()->to('/owner/dashboard'); // Dashboard owner
    } else {
        $session->setFlashdata('error', 'Level pengguna tidak valid.');
        return redirect()->to('/login');
    }
} else {
    $session->setFlashdata('error', 'Username atau password salah.');
    return redirect()->to('/login');
}
}

    // Fungsionalitas logout
    public function logout()
    {
        $session = session();
        $session->destroy(); // Menghapus session
        return redirect()->to('/login'); // Redirect ke halaman login
    }
}
