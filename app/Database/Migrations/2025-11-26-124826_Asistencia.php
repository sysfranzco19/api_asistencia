<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Asistencia extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true
            ],
            'fecha_clase' => [
                'type' => 'DATE',
                'null' => true
            ],
            'estado' => [
                'type' => "ENUM('Presente','Retraso','Ausente','Licencia')",
                'null' => true
            ],
            'estudiante_id' => [
                'type' => 'INT',
                'null' => false
            ],
            'created_at' => ['type' => 'DATETIME', 'null' => false],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
            'deleted_at' => ['type' => 'DATETIME', 'null' => true],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('estudiante_id', 'estudiante', 'id', 'NO ACTION', 'NO ACTION');

        $this->forge->createTable('asistencia');
    }

    public function down()
    {
        $this->forge->dropTable('asistencia');
    }
}
