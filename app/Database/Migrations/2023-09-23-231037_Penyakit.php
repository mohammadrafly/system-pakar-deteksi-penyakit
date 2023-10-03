<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Penyakit extends Migration
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
            'kodepenyakit' => [
                'type' => 'VARCHAR',
                'constraint' => '25'
            ],
            'namapenyakit' => [
                'type' => 'TEXT'
            ],
            'jenistanaman' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'kulturteknis' => [
                'type' => 'TEXT'
            ],
            'fisikmekanis' => [
                'type' => 'TEXT'
            ],
            'kimiawi' => [
                'type' => 'TEXT'
            ],
            'hayati' => [
                'type' => 'TEXT'
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
        $this->forge->addKey('jenistanaman');
        $this->forge->createTable('penyakit');
    }

    public function down()
    {
        $this->forge->dropTable('penyakit');
    }
}
