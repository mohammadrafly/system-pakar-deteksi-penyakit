<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class BasisPengetahuan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'namapenyakit' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'gejala' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'nilaibobot' => [
                'type' => 'DOUBLE',
                'null' => false,
            ],
            'created_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
            'updated_at' => [
                'type'    => 'TIMESTAMP',
                'default' => new RawSql('CURRENT_TIMESTAMP'),
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('basispengetahuan');
    }

    public function down()
    {
        $this->forge->dropTable('basispengetahuan');
    }
}
