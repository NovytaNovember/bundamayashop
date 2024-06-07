<?php

namespace App\Controllers;

class Pendaftaran_kepalasekolah extends BaseController
{
    public function index()
    {
        return view('kepala_sekolah/pendaftaran/pendaftaran_kepalasekolah.php');
    }
    
    public function detail()
    {
        return view('kepala_sekolah/pendaftaran/detail_pendaftaran_kepalasekolah.php');
    }
    
    
}
