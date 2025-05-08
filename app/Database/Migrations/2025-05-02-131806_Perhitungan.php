<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Perhitungan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_perhitungan'    => ['type' => 'INT', 'auto_increment' => true],
            'pendapatan_hari_ini' => ['type' => 'VARCHAR', 'constraint' => 20],
            'tanggal'           => ['type' => 'DATE'],
            'pendapatan'        => ['type' => 'VARCHAR', 'constraint' => 20],
            'modal'             => ['type' => 'VARCHAR', 'constraint' => 20],
            'keuntungan'        => ['type' => 'VARCHAR', 'constraint' => 20],
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
