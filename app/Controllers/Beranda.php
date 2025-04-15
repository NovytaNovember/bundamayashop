<?php

namespace App\Controllers;

class Beranda extends BaseController
{
    public function index(): string
    {
        $level = session()->get('level');

        if ($level == 'kepsek') {
            return view('kepala_sekolah/beranda/beranda');
        } elseif ($level == 'peserta') {
            return view('free_user/beranda/beranda');
        } else {
            // Default view if level is not recognized
            return view('free_user/beranda/beranda');
        }
    }

    public function profil(): string
    {
        return view('free_user/profil/profil');
    }
}
