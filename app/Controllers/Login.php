<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_akun;
use CodeIgniter\HTTP\ResponseInterface;

class Login extends BaseController
{
    protected $akun;

    public function __construct()
    {
        $this->akun = new M_akun();
    }

    public function index()
    {
        // $akun = $this->akun->findAll();
        // dd($akun);
        // die;
        return view('free_user/login');
    }

    public function login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $userIsFound = $this->akun->getAkunByUsername($username);

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
            if ($userIsFound && password_verify("$password", $userIsFound['password'])) {
                session()->set('isLogin', true);
                session()->set('id_akun', $userIsFound['id_akun']);
                session()->set('username', $userIsFound['username']);
                session()->set('password', $userIsFound['password']);
                session()->set('level', $userIsFound['level']);
                return redirect()->to(base_url('berhasil'));
            } else {
                session()->setFlashdata('pesan', 'Username atau password salah.');
                return redirect()->back()->withInput();
            }
        } else {
            return redirect()->back()->withInput()->with('pesan', 'Username dan Password Tidak Boleh Kosong');
        }
    }
}