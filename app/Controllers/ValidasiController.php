<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_akun;

class ValidasiController extends BaseController
{
    protected $akun;

    public function __construct()
    {
        $this->akun = new M_akun();
    }

    public function index()
    {
        return view('free_user/login');
    }

    public function login()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $this->akun->getLogin($username);

        $validate = $this->validate([
            'username' => [
                'label' => 'Username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong.',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Tidak Boleh Kosong.'
                ]
            ]
        ]);

        if ($validate) {
            if ($user && password_verify("$password", $user['password'])) {
                session()->set('isLogin', true);
                session()->set('id_akun', $user['id_akun']);
                session()->set('username', $user['username']);
                session()->set('password', $user['password']);
                session()->set('level', $user['level']);

                session()->setFlashdata('welcome_message', 'Selamat datang, ' . $user['username'] . '!');

                if ($user['level'] == 'admin') {
                    return redirect()->to(base_url('dashboard_admin'));
                } elseif ($user['level'] == 'peserta' || $user['level'] == 'kepsek') {
                    return redirect()->to(base_url('beranda'));
                } else {
                    return redirect()->back()->with('pesan', 'Gak Boleh !!');
                }
            } else {
                session()->setFlashdata('pesan', 'Username atau password salah.');
                return redirect()->back()->withInput();
            }
        } else {
            return redirect()->back()->withInput()->with('pesan', 'Username dan Password Tidak Boleh Kosong');
        }
    }

    public function logout()
    {
        session()->remove('isLogin');
        session()->remove('id_akun');
        session()->remove('username');
        session()->remove('password');
        session()->remove('level');
        return redirect()->to('beranda');
    }

    public function registrasi()
    {
        return view('free_user/registrasi');
    }

    public function simpanRegistrasi()
    {

        $validate = $this->validate([
            'username' => [
                'label' => 'username',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.'
                ]
            ],
            'password_confirm' => [
                'label' => "Konfirmasi Password",
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                    'matches' => 'Konfirmasi password tidak sama dengan password !!'
                ]
            ]
        ]);

        if ($validate) {
            $password = $this->request->getPost('password');
            $hash_password = password_hash("$password", PASSWORD_BCRYPT);
            $data = [
                'username' => $this->request->getPost('username'),
                'password' => $hash_password,
                'level' => 'peserta' // Sesuaikan level dengan kebutuhan
            ];

            $this->akun->addData($data);

            session()->setFlashdata('berhasil', 'Registrasi berhasil! Silakan login.');

            return redirect()->to(base_url('login'));
        } else {
            return redirect()->to('registrasi')->with('error', $this->validator->listErrors());
        }
    }
}
