<?php

namespace App\Controllers;

class Pendaftaran extends BaseController
{
    public function index()
    {
        
        return view('admin/pendaftaran/pendaftaran.php');

    }

    public function tambah()
    {
        $data = [
            'sidebar' => 'Pendaftaran',
        ];

        return view('admin/pendaftaran/form_pendaftaran.php', $data);
    }

    public function simpan()
    {
        $data = [
            'sidebar' => 'Pendaftaran',
        ];


        return view('admin/pendaftaran/pendaftaran.php');

    }

    public function edit()
    {

        return view('admin/pendaftaran/form_edit_pendaftaran.php');

    }

    public function update()
    {

        
        return view('admin/pendaftaran/pendaftaran.php');

    }

    public function detail()
    {
        return view('admin/pendaftaran/detail_pendaftaran.php');

    }

    public function hapus()
    {
        $data = [
            'sidebar' => 'Pendaftaran',
        ];

        return view('admin/pendaftaran/pendaftaran.php');

    }
}
