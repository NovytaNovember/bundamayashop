<?php

namespace App\Controllers;

class Pengumuman_kepalasekolah extends BaseController
{
    public function index()
    {
        return view('kepala_sekolah/pengumuman/pengumuman_kepalasekolah.php');
    }
    
    public function hasil()
    {
        return view('kepala_sekolah/pengumuman/hasil_pengumuman_kepalasekolah.php');

    }
}
