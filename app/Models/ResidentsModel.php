<?php namespace App\Models;

use CodeIgniter\Model;

class ResidentsModel extends Model
{
    protected $table         = 'residents';
    protected $allowedFields = [
        'resident_first_name', 'resident_last_name'
    ];
    protected $returnType    = 'App\Entities\Resident';
    protected $useTimestamps = true;
}