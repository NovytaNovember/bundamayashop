<?php

namespace App\Controllers;

class Profil extends BaseController
{
    public function edit_profil()
    {
        return view('admin/profil/edit_profil');
    }

    public function form_edit_profil()
    {
        $data['judul'] = 'Form Edit Profil';
        return view('admin/profil/form_edit_profil', $data);
    }
}
