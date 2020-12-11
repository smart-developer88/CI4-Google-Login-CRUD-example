<?php namespace App\Entities;

use CodeIgniter\Entity;

class Report extends Entity
{
    protected $dates = ['shift_date', 'created_at', 'updated_at'];
}