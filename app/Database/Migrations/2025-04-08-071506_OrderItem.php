<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RincianProdukTerjual extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_rincian_produk_terjual' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_produk_terjual' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'id_produk' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'jumlah' => [
                'type' => 'INT',
            ],
            'total_harga' => [
               'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ]
        ]);

        $this->forge->addKey('id_rincian_produk_terjual', true); // Primary Key

        // Foreign Key ke tabel produk_terjual
        $this->forge->addForeignKey('id_produk_terjual', 'produk_terjual', 'id_produk_terjual', 'CASCADE', 'CASCADE');

        // Foreign Key ke tabel produk
        $this->forge->addForeignKey('id_produk', 'produk', 'id_produk', 'CASCADE', 'CASCADE');

        $this->forge->createTable('rincian_produk_terjual');
    }

    public function down()
    {
        $this->forge->dropTable('rincian_produk_terjual');
    }
}

