<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Estudiante extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true
            ],
            'codigo' => [
                'type' => 'INT',
                'null' => true,
            ],
            'nombre_estudiante' => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true,
            ],
            'clase_id' => [
                'type' => 'INT',
                'null' => false,
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => false],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('clase_id', 'clase', 'id', 'NO ACTION', 'NO ACTION');
        
        $this->forge->createTable('estudiante');
    }

    public function down()
    {
        $this->forge->dropTable('estudiante');
    }
}
