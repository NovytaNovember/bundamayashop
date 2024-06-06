<?php

namespace App\Controllers;

use App\Models\M_kegiatan;
use App\Models\M_tenaga_pendidik;

class Kegiatan extends BaseController
{

    protected $kegiatan;
    protected $tendik;

    public function __construct()
    {
        $this->kegiatan = new M_kegiatan();
        $this->tendik = new M_tenaga_pendidik();
    }

    public function index()
    {
        $data = [
            'kegiatan' => $this->kegiatan->getKegiatan(),
            'judul' => 'Data Kegiatan'
        ];

        return view('admin/kegiatan/kegiatan', $data);
    }

    public function tambah()
    {
        $data['tendik'] = $this->tendik->getTendik();
        return view('admin/kegiatan/form_tambah_kegiatan', $data);
    }

    public function simpan()
    {
        $validate = $this->validate([
            'judul' => [
                'label' => 'Judul',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.',
                ]
            ],
            'status' => [
                'label' => 'Status',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.'
                ]
            ],
            'tanggal_dibuat' => [
                'label' => 'Tanggal Dibuat',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong.'
                ]
            ],
            // 'gambar' => [
            //     'label' => 'Gambar',
            //     'rules' => 'uploaded[gambar]',
            //     'errors' => [
            //         'uploaded' => 'Gambar tidak boleh kosong',
            //     ]
            // ],
        ]);



        if ($validate) {


            $this->kegiatan->insert(
                [
                    'judul' => esc($this->request->getPost('judul')),
                    'status' => esc($this->request->getPost('status')),
                    'id_tendik' => esc($this->request->getPost('id_tendik')),
                    'tanggal_dibuat' => esc($this->request->getPost('tanggal_dibuat')),
                    'tanggal_diubah' => "12-12-2012",
                    'gambar' => "gambar"
                ]
            );
            return redirect()->to('tambah_kegiatan')->with('pesan', 'Data Berhasil Ditambah !');
        } else {
            return redirect()->to('tambah_kegiatan')->with('error', 'Data Gagal Ditambah !');
        }
    }
    public function edit()
    {
        return view('admin/kegiatan/form_edit_kegiatan');
    }

    public function hapus()
    {
        return view('admin/kegiatan/form_hapus_kegiatan');
    }
}
