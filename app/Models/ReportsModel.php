<?php namespace App\Models;

use CodeIgniter\Model;

class ReportsModel extends Model
{
    protected $table         = 'shift_reports';
    protected $allowedFields = [
        'id',
        'house_id',
        'reporter_name',
        'shift_date',
        'shift_timing',

        'shift_prn_count1',
        'shift_prn_count2',
        'shift_prn_count3',
        'shift_prn_count4',
        'shift_med_check_times1',
        'shift_med_check_times2',
        'shift_isResident',
        'shift_isUrinal',
        'shift_isKeysHandOver',
        'shift_isCamera',
        'shift_isChecked',

        'safety_isLiftBatteryCharging',
        'safety_isFireCheckList',
        'safety_isCameraCheck',
        'safety_isPreWorkStretches',
        'safety_isChecked',

        'meds_time1',
        'meds_administered_by1',
        'meds_checked_by1',
        'meds_time2',
        'meds_administered_by2',
        'meds_checked_by2',
        'meds_time3',
        'meds_administered_by3',
        'meds_checked_by3',

        'prns_administered_time',
        'resident_id',
        'prns_administered_medication',
        'prns_administered_administered_by',
        'prns_administered_witnessed_by',
        'prns_administered_approved_by',

        'dietary_breakfast',
        'dietary_am_snack',
        'dietary_lunch',
        'dietary_pm_snack',
        'dietary_supper',
        'dietary_evening_snack',
        
        'notes',
    ];
    protected $returnType    = 'App\Entities\Report';
    protected $useTimestamps = true;
}