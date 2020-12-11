<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddLoginTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'login_id'       => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'login_email'    => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'login_datetime' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            
            'created_at' => [
                'type'       => 'datetime',
            ],
            'updated_at' => [
                'type'       => 'datetime',
            ],
        ]);
        $this->forge->addKey('login_id', true);
        $this->forge->createTable('login');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('login');
    }
}
