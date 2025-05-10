<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\ProdukModel;

class ProdukController extends BaseController
{
    public function index()
    {
        $model = new ProdukModel();
        $modelKategori = new KategoriModel();

        // Ambil semua data produk
        $data = [
            'judul' => 'Data Produk',
            'produk' => $model->join('kategori', 'produk.id_kategori = kategori.id_kategori')->findAll(),
            'kategori' => $modelKategori->findAll()
        ];

        // Menampilkan view dengan data produk
        return view('admin/produk', $data);  // Pastikan ini memanggil admin/produk.php
    }

    public function store()
    {
        $model = new ProdukModel();

        // Ambil data dari form
        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'harga'       => $this->request->getPost('harga'),
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        // Proses upload gambar
        $gambar = $this->request->getFile('gambar');
        if ($gambar->isValid() && !$gambar->hasMoved()) {
            $gambarName = $gambar->getRandomName();
            $gambar->move(FCPATH . 'uploads', $gambarName);
            $data['gambar'] = $gambarName;
        }

        if ($model->insert($data)) {
            session()->setFlashdata('pesan', 'Data produk berhasil ditambahkan!');
        } else {
            session()->setFlashdata('error', 'Gagal menyimpan data produk.');
        }

        return redirect()->to('/admin/produk');
    }

  

    public function update()
    {
        $id = $this->request->getPost('id_produk');
        $model = new ProdukModel();

        // Validasi form
        $validation = \Config\Services::validation();
        if (!$this->validate([
            'nama_produk' => 'required|min_length[3]',
            'deskripsi'   => 'required',
            'id_kategori' => 'required',
            'harga'       => 'required|numeric',
            'gambar'      => 'is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]',
        ])) {
            return redirect()->back()->withInput()->with('error', 'Validasi gagal');
        }

        // Ambil data dari form
        $data = [
            'nama_produk' => $this->request->getPost('nama_produk'),
            'deskripsi'   => $this->request->getPost('deskripsi'),
            'id_kategori' => $this->request->getPost('id_kategori'),
            'harga'       => $this->request->getPost('harga'),
            'updated_at'  => date('Y-m-d H:i:s'),
        ];

        // Ambil file gambar jika ada
        $gambar = $this->request->getFile('gambar');

        // Jika ada gambar yang diupload, proses upload
        if ($gambar && $gambar->isValid() && !$gambar->hasMoved()) {
            // Cek apakah file gambar sebelumnya ada, dan hapus jika ada
            $produk = $model->find($id);
            $oldImage = $produk['gambar'];

            if ($oldImage && file_exists(FCPATH . 'uploads/' . $oldImage)) {
                unlink(FCPATH . 'uploads/' . $oldImage);
            }

            $newGambarName = $gambar->getRandomName();
            $gambar->move(FCPATH . 'uploads', $newGambarName);
            $data['gambar'] = $newGambarName;
        }

        // Update data di database
        if ($model->update($id, $data)) {
            session()->setFlashdata('pesan', 'Data produk berhasil diperbarui!');
        } else {
            session()->setFlashdata('error', 'Gagal memperbarui data produk.');
        }

        return redirect()->to('/admin/produk');
    }

    public function delete($id)
    {
        $model = new ProdukModel();

        // Hapus data berdasarkan ID
        if ($model->delete($id)) {
            session()->setFlashdata('pesan', 'Data produk berhasil dihapus!');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus data produk.');
        }

        return redirect()->to('/admin/produk');
    }
}
