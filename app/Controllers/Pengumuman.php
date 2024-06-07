<?php

namespace App\Controllers;

class Pengumuman extends BaseController
{
    public function index()
    {
        $data = [
            'sidebar' => 'Pengumuman',
        ];
        return view('admin/pengumuman/pengumuman.php',$data);

    }

    public function tambah()
    {
        $data = [
            'sidebar' => 'Pengumuman',
        ];

        return view('admin/pengumuman/form_pengumuman.php',$data);

    }

    public function simpan()
    {
        $data = [
            'sidebar' => 'Pengumuman',
        ];

        return view('admin/pengumuman/pengumuman.php');

    }

    public function edit()
    {
        $data = [
            'sidebar' => 'Pengumuman',
        ];
        return view('admin/pengumuman/form_edit_pengumuman.php',$data);

    }

    public function update()
    {
        $data = [
            'sidebar' => 'Pengumuman',
        ];
        
        return view('admin/pengumuman/pengumuman.php');

    }

    public function detail_hasil()
    {
        $data = [
            'sidebar' => 'Pengumuman',
        ];
        return view('admin/pengumuman/detail_hasil_pengumuman.php',$data);

    }

    public function hapus()
    {
        $data = [
            'sidebar' => 'Pengumuman',
        ];
        return view('admin/pengumuman/pengumuman.php');

    }
    

    
}
