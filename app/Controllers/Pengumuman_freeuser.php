<?php

namespace App\Controllers;

class Pengumuman_freeuser extends BaseController
{
    public function index()
    {
        return view('free_user/pengumuman/pengumuman.php');
    }
    
    public function hasil()
    {
        return view('free_user/pengumuman/hasil_pengumuman.php');

    }
}
