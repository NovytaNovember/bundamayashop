<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TotalPenjualan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_total_penjualan' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_transaksi' => [
                'type'       => 'INT',
                'unsigned'   => true,
            ],
            'total_harga' => [
                'type' => 'INT',
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

        $this->forge->addKey('id_total_penjualan', true); // Primary key

        // // Foreign key ke penjualan.id_transaksi
        // $this->forge->addForeignKey('id_transaksi', 'penjualan', 'id_transaksi');

        $this->forge->createTable('total_penjualan');
    }

    public function down()
    {
        $this->forge->dropTable('total_penjualan');
    }
}