<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Usuario extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'nombre' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'apellido' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '200',
                'null' => true
            ],
            'admin' => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'default' => 0,
                'null' => true
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '300',
                'null' => true
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);
        
        $this->forge->addKey('id', true);
        $this->forge->createTable('usuario');
    }

    public function down()
    {
        $this->forge->dropTable('usuario');
    }
}
