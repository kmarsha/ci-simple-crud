<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PhotosTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'int',
                'constraint' => 20,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'varchar',
                'constraint' => 100,
            ],
            'type' => [
                'type' => 'varchar',
                'constraint' => 255,
            ],
            'created_at' => [
                'type' => 'varchar',
                'constraint' => 20,
            ],
        ]);

        $this->forge->addPrimaryKey('id');

        $this->forge->createTable('photos');
    }

    public function down()
    {
        $this->forge->dropTable('photos');
    }
}
