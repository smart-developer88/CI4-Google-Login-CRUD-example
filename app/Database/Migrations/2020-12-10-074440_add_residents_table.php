<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddResidentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'resident_first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '32',
            ],
            'resident_last_name'  => [
                'type'       => 'VARCHAR',
                'constraint' => '32',
            ],
            
            'created_at' => [
                'type'       => 'datetime',
            ],
            'updated_at' => [
                'type'       => 'datetime',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('residents');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('residents');
    }
}
