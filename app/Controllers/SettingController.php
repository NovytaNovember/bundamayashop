<?php

namespace App\Controllers;

use App\Models\SettingModel;
use CodeIgniter\Controller;

class SettingController extends BaseController
{
    protected $settingModel;

    public function __construct()
    {
        $this->settingModel = new SettingModel();
    }

    /**
     * Tampilkan semua setting
     */
    public function index()
    {
        $data['settings'] = $this->settingModel->findAll();
        $data['judul']    = 'Pengaturan Toko';
        return view('admin/setting/index', $data);
    }

    /**
     * Simpan setting baru
     */
    public function store()
    {
        $fileLogo = $this->request->getFile('logo');
        $logoName = null;

        if ($fileLogo && $fileLogo->isValid() && ! $fileLogo->hasMoved()) {
            $logoName = $fileLogo->getRandomName();
            $fileLogo->move('uploads/logo/', $logoName);
        }

        $this->settingModel->save([
            'nama_toko'       => $this->request->getPost('nama_toko'),
            'alamat'          => $this->request->getPost('alamat'),
            'no_hp'           => $this->request->getPost('no_hp'),
            'email'           => $this->request->getPost('email'),
            'jam_operasional' => $this->request->getPost('jam_operasional'),
            'logo'            => $logoName,
            'created_at'      => date('Y-m-d H:i:s'),
            'updated_at'      => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/admin/setting')->with('pesan', 'Setting berhasil ditambahkan.');
    }

    /**
     * Update setting
     */
    public function update()
    {
        $id = $this->request->getPost('id_setting');

        $data = [
            'nama_toko'       => $this->request->getPost('nama_toko'),
            'alamat'          => $this->request->getPost('alamat'),
            'no_hp'           => $this->request->getPost('no_hp'),
            'email'           => $this->request->getPost('email'),
            'jam_operasional' => $this->request->getPost('jam_operasional'),
            'updated_at'      => date('Y-m-d H:i:s'),
        ];

        $fileLogo = $this->request->getFile('logo');
        if ($fileLogo && $fileLogo->isValid() && ! $fileLogo->hasMoved()) {
            $newName = $fileLogo->getRandomName();
            $fileLogo->move('uploads/logo/', $newName);
            $data['logo'] = $newName;
        }

        $this->settingModel->update($id, $data);

        return redirect()->to('/admin/setting')->with('pesan', 'Setting berhasil diupdate.');
    }

    /**
     * Hapus setting
     */
    public function delete($id)
    {
        $this->settingModel->delete($id);
        return redirect()->to('/admin/setting')->with('pesan', 'Setting berhasil dihapus.');
    }
}
