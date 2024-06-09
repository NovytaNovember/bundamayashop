<?php

namespace App\Controllers;

use App\Models\M_kegiatan;
use App\Models\M_tenaga_pendidik;

class Kegiatan extends BaseController
{

    protected $kegiatan;
    protected $tendik;
    public $ModelKegiatan;

    public function __construct()
    {
        $this->kegiatan = new M_kegiatan();
        $this->ModelKegiatan = new \App\Models\ModelKegiatan();
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

        $data = [
            'tendik' => $this->tendik->getTendik(),
            'kegiatan' => $this->kegiatan->getKegiatan(),
            'judul' => 'Data Tambah Kegiatan'
        ];

        return view('admin/kegiatan/form_tambah_kegiatan', $data);
    }

    public function simpan()
    {

        $data = [
            'judul' => $this->request->getPost('judul'),
            'status' => $this->request->getPost('status'),
            'id_tendik' => $this->request->getPost('id_tendik'),
            'tanggal_dibuat' => $this->request->getPost('tanggal_dibuat'),
            'tanggal_diubah' => "12-12-2012",
            'gambar' => "gambar"
        ];
        $this->ModelKegiatan->insert($data);
        return redirect()->to(base_url('tambah_kegiatan'))->with('pesan', 'Data Berhasil Ditambah !');
        die;
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
            'gambar' => [
                'label' => 'Gambar',
                'rules' => 'uploaded[gambar]',
                'errors' => [
                    'uploaded' => 'Gambar tidak boleh kosong',
                ]
            ],
        ]);


        if ($validate) {
            return redirect()->to('tambah_kegiatan')->with('pesan', 'Data Berhasil Ditambah !');
        } else {
            return redirect()->to('tambah_kegiatan')->with('error', 'Data Gagal Ditambah !');
        }
    }
    public function edit(int $id)
    {
        $kegiatan = $this->ModelKegiatan->find($id);
        $updateData = [
            'id_kegiatan' => $kegiatan['id_kegiatan'],
            'judul' => $kegiatan['judul'],
            'id_tendik' => $kegiatan['id_tendik'],
            'status' => $kegiatan['status'],
            'tanggal_dibuat' => $kegiatan['tanggal_dibuat'],
            'tanggal_diubah' => $kegiatan['tanggal_diubah'],
            'gambar' => $kegiatan['gambar'],
        ];
        $data = [
            'tendik' => $this->tendik->getTendik(),
            'kegiatan' => $this->kegiatan->getKegiatan(),
            'judul' => 'Data Edit Kegiatan',
            'data' => $updateData
        ];
        return view('admin/kegiatan/form_edit_kegiatan', $data);
    }

    public function simpanedit($id)
    {
        $data = [
            'judul' => $this->request->getPost('judul'),
            'status' => $this->request->getPost('status'),
            'tanggal_dibuat' => $this->request->getPost('tanggal_dibuat'),
            'tanggal_diubah' => $this->request->getPost('tanggal_diubah'),
            'gambar' => $this->request->getPost('gambar'),
        ];

        $this->ModelKegiatan->where('id_kegiatan', $id)->set($data)->update();
        return redirect()->to(base_url('kegiatans'))->with('pesan', 'Data Berhasil Diedit !');
        die;
    }


    public function hapus($id)
    {
        $this->ModelKegiatan->where('id_kegiatan', $id)->delete();
        return redirect()->to(base_url('kegiatans'))->with('pesan', 'Data Berhasil Dihapus !');
    }
}
