<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddResidentsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'resident_id'         => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'resident_first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'resident_last_name'  => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('resident_id', true);
        $this->forge->createTable('residents');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('residents');
    }
}
