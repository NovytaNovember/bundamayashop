<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateOrderItem extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_order_item' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_order' => [
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

        $this->forge->addKey('id_order_item', true); // Primary Key

        // Foreign Key ke tabel order
        $this->forge->addForeignKey('id_order', 'order', 'id_order', 'CASCADE', 'CASCADE');

        // Foreign Key ke tabel produk
        $this->forge->addForeignKey('id_produk', 'produk', 'id_produk', 'CASCADE', 'CASCADE');

        $this->forge->createTable('order_item');
    }

    public function down()
    {
        $this->forge->dropTable('order_item');
    }
}
