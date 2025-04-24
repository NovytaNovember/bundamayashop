<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use CodeIgniter\Controller;

class KategoriController extends BaseController
{
    protected $kategoriModel;

    public function __construct()
    {
        $this->kategoriModel = new KategoriModel();
    }

    public function index()
    {
        $data['kategori'] = $this->kategoriModel->findAll();
        $data['judul'] = 'Data Kategori';
        return view('admin/kategori/kategori', $data);
    }

    public function store()
    {
        $this->kategoriModel->save([
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),

        ]);

        return redirect()->to('/admin/kategori')->with('pesan', 'Data kategori berhasil ditambahkan.');
    }

    public function update()
    {
        $this->kategoriModel->update($this->request->getPost('id_kategori'), [
            'nama_kategori' => $this->request->getPost('nama_kategori'),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/admin/kategori')->with('pesan', 'Data kategori berhasil diupdate.');
    }

    public function delete($id)
    {
        $this->kategoriModel->delete($id);
        return redirect()->to('/admin/kategori')->with('pesan', 'Data kategori berhasil dihapus.');
    }
}
