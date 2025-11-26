<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Clase extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true
            ],
            'nombre_clase' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true
            ],
            'abreviado' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => true
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => false],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('clase');
    }

    public function down()
    {
        $this->forge->dropTable('clase');
    }
}
