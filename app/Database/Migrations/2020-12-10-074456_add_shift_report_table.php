<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddShiftReportTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                         => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'house_id'                          => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'reporter_name'                     => [
                'type'       => 'varchar',
                'constraint' => 64,
                'null'       => true,
            ],
            'shift_date'                        => [
                'type' => 'date',
            ],
            'shift_timing'                      => [
                'type'       => 'varchar',
                'constraint' => 32,
            ],
            'shift_prn_count1'                  => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'shift_prn_count2'                  => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'shift_prn_count3'                  => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'shift_prn_count4'                  => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'shift_med_check_times1'            => [
                'type' => 'time',
            ],
            'shift_med_check_times2'            => [
                'type' => 'time',
            ],
            'shift_isResident'                  => [
                'type' => 'boolean',
            ],
            'shift_isUrinal'                    => [
                'type' => 'boolean',
            ],
            'shift_isKeysHandOver'              => [
                'type' => 'boolean',
            ],
            'shift_isCamera'                    => [
                'type' => 'boolean',
            ],
            'shift_isChecked'                   => [
                'type' => 'boolean',
            ],

            'safety_isLiftBatteryCharging'      => [
                'type' => 'boolean',
            ],
            'safety_isFireCheckList'            => [
                'type' => 'boolean',
            ],
            'safety_isCameraCheck'              => [
                'type' => 'boolean',
            ],
            'safety_isPreWorkStretches'         => [
                'type' => 'boolean',
            ],
            'safety_isChecked'                  => [
                'type' => 'boolean',
            ],

            'meds_time1'                        => [
                'type' => 'time',
            ],
            'meds_administered_by1'             => [
                'type'       => 'varchar',
                'constraint' => 64,
            ],
            'meds_checked_by1'                  => [
                'type'       => 'varchar',
                'constraint' => 64,
            ],

            'meds_time2'                        => [
                'type' => 'time',
            ],
            'meds_administered_by2'             => [
                'type'       => 'varchar',
                'constraint' => 64,
            ],
            'meds_checked_by2'                  => [
                'type'       => 'varchar',
                'constraint' => 64,
            ],

            'meds_time3'                        => [
                'type' => 'time',
            ],
            'meds_administered_by3'             => [
                'type'       => 'varchar',
                'constraint' => 64,
            ],
            'meds_checked_by3'                  => [
                'type'       => 'varchar',
                'constraint' => 64,
            ],

            'prns_administered_time'            => [
                'type' => 'time',
            ],
            'resident_id'                       => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'prns_administered_medication'      => [
                'type'       => 'varchar',
                'constraint' => 64,
            ],
            'prns_administered_administered_by' => [
                'type'       => 'varchar',
                'constraint' => 64,
            ],
            'prns_administered_witnessed_by'    => [
                'type'       => 'varchar',
                'constraint' => 64,
            ],
            'prns_administered_approved_by'     => [
                'type'       => 'varchar',
                'constraint' => 64,
            ],

            'dietary_breakfast'                 => [
                'type'       => 'varchar',
                'constraint' => 256,
            ],
            'dietary_am_snack'                  => [
                'type'       => 'varchar',
                'constraint' => 256,
            ],
            'dietary_lunch'                     => [
                'type'       => 'varchar',
                'constraint' => 256,
            ],
            'dietary_pm_snack'                  => [
                'type'       => 'varchar',
                'constraint' => 256,
            ],
            'dietary_supper'                    => [
                'type'       => 'varchar',
                'constraint' => 256,
            ],
            'dietary_evening_snack'             => [
                'type'       => 'varchar',
                'constraint' => 256,
            ],

            'notes'                             => [
                'type'       => 'text',
            ],
            
            'created_at' => [
                'type'       => 'datetime',
            ],
            'updated_at' => [
                'type'       => 'datetime',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('house_id', 'houses', 'id');
        $this->forge->addForeignKey('resident_id', 'residents', 'id');
        $this->forge->createTable('shift_reports');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('shift_reports');
    }
}
