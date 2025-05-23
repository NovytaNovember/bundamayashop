<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateModalHistoryTable extends Migration
{
    public function up()
    {
        // Membuat tabel modal_history
        $this->forge->addField([
            'id_modal' => [
                'type'           => 'INT',
                'unsigned'      => true,
                'auto_increment' => true,
            ],
            'tanggal' => [
                'type' => 'DATE',
                'null' => false,
            ],
            'modal' => [
                'type'    => 'VARCHAR',
                'constraint' => '20',
                'null'    => false,
                'default' => '0',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
                'default' => 'CURRENT_TIMESTAMP',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
                'default' => 'CURRENT_TIMESTAMP',
                'on_update' => 'CURRENT_TIMESTAMP',
            ],
        ]);

        // Menambahkan primary key
        $this->forge->addKey('id_modal', true);

        // Membuat tabel
        $this->forge->createTable('modal_history');
    }

    public function down()
    {
        // Menghapus tabel modal_history
        $this->forge->dropTable('modal_history');
    }
}
