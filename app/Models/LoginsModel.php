<?php namespace App\Models;

use CodeIgniter\Model;

class LoginsModel extends Model
{
    protected $table         = 'logins';
    protected $allowedFields = [
        'login_email',
        'login_datetime'
    ];
    protected $returnType    = 'App\Entities\Login';
    protected $useTimestamps = true;
}