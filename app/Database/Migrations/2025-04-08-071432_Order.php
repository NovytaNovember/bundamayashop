<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProdukTerjual extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_produk_terjual' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'total_harga' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
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

        $this->forge->addKey('id_produk_terjual', true); // Primary key
        $this->forge->createTable('produk_terjual');
    }

    public function down()
    {
        $this->forge->dropTable('produk_terjual');
    }
}
