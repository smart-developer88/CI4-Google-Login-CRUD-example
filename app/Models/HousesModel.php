<?php namespace App\Models;

use CodeIgniter\Model;

class HousesModel extends Model
{
    protected $table         = 'houses';
    protected $allowedFields = [
        'house_name'
    ];
    protected $returnType    = 'App\Entities\House';
    protected $useTimestamps = true;
}