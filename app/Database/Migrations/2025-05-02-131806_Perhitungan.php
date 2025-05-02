<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Perhitungan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_perhitungan'    => ['type' => 'INT', 'auto_increment' => true],
            'id_produk'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true], // Pastikan unsigned
            'tanggal'           => ['type' => 'DATE'],
            'pendapatan'        => ['type' => 'DECIMAL', 'constraint' => '15,2'],
            'modal'             => ['type' => 'DECIMAL', 'constraint' => '15,2'],
            'keuntungan'        => ['type' => 'DECIMAL', 'constraint' => '15,2'],
            'created_at'        => ['type' => 'DATETIME', 'null' => true],
            'updated_at'        => ['type' => 'DATETIME', 'null' => true],
        ]);
        
        $this->forge->addKey('id_perhitungan', true);
        $this->forge->addForeignKey('id_produk', 'produk', 'id_produk', 'CASCADE', 'CASCADE');  // Menambahkan foreign key constraint
        $this->forge->createTable('perhitungan');
    }

    public function down()
    {
        $this->forge->dropTable('perhitungan');
    }
}
