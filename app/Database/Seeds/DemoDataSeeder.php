<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DemoDataSeeder extends Seeder
{
    public function run()
    {
        $this->call('HousesSeeder');
        $this->call('ResidentsSeeder');
        $this->call('ReportsSeeder');
    }
}
