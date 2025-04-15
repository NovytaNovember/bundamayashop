<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_produk' => 'Donat Coklat',
                'deskripsi' => 'Donat empuk dengan taburan coklat',
                'id_kategori' => 1, // Kue Basah
                'gambar' => 'donat-coklat.jpg',
                'harga' => 5000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_produk' => 'Nastar Keju',
                'deskripsi' => 'Kue kering isi nanas dengan keju',
                'id_kategori' => 2, // Kue Kering
                'gambar' => 'nastar-keju.jpg',
                'harga' => 30000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'nama_produk' => 'Roti Sosis',
                'deskripsi' => 'Roti isi sosis dengan keju leleh',
                'id_kategori' => 3, // Roti
                'gambar' => 'roti-sosis.jpg',
                'harga' => 7000,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ];

        $this->db->table('produk')->insertBatch($data);
    }
}
