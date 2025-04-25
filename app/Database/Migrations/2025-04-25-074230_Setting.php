<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Setting extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_setting'      => ['type' => 'INT', 'auto_increment' => true],
            'nama_toko'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'alamat'          => ['type' => 'TEXT'],
            'no_hp'           => ['type' => 'VARCHAR', 'constraint' => 15],
            'email'           => ['type' => 'VARCHAR', 'constraint' => 100],
            'jam_operasional' => ['type' => 'VARCHAR', 'constraint' => 100],
            'logo'            => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at'      => ['type' => 'DATETIME', 'null' => true],
            'updated_at'      => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id_setting', true);
        $this->forge->createTable('setting');
    }

    public function down()
    {
        $this->forge->dropTable('setting');
    }
}
