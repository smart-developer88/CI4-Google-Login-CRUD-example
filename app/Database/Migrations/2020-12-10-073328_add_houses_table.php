<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddHousesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'   => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'house_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            
            'created_at' => [
                'type'       => 'datetime',
            ],
            'updated_at' => [
                'type'       => 'datetime',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('houses');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('houses');
    }
}
