<?php

namespace App\Controllers;

use App\Models\M_Profil;

class Profil extends BaseController
{
    protected $profil;
    public $M_Profil;

    public function __construct()
    {
        $this->profil = new M_Profil();
        $this->M_Profil = new \App\Models\M_Profil();
    }

    public function edit_profil()
    {
        $data = [
            'profil' => $this->profil->findAll(),
            'judul' => 'Data Profil'
        ];

        return view('admin/profil/edit_profil', $data);
    }
	

    public function simpanedit($id)
    {
        $data = [
            'id_profil' => $this->request->getPost('id_profil'),
            'tanggal_dibuat' => $this->request->getPost('tanggal_dibuat'),
            'visi_misi' => $this->request->getPost('visi_misi'),
            'tujuan' => $this->request->getPost('tujuan'),
            'struktur_organisasi' => $this->request->getPost('struktur_organisasi'),
            'sejarah_sekolah' => $this->request->getPost('sejarah_sekolah'),
        ];

        $this->M_Profil->where('id_profil', $id)->set($data)->update();
        return redirect()->to(base_url('profil_admin'))->with('pesan', 'Data Berhasil Diedit !');
        die;
    }

    public function form_edit_profil()
    {
        $data = [
            'data' => $this->profil->findAll(),
            'judul' => 'Form Edit Profil'
        ];
            return view('admin/profil/form_edit_profil', $data);
    }
}
