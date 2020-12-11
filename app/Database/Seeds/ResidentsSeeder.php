<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Entities\Resident;
use App\Models\ResidentsModel;

class ResidentsSeeder extends Seeder
{
    public function run()
    {
        $residentsModel = new ResidentsModel();
        $demo_residents = ['John Jones', 'Mary Smith', 'Bill Caplan', 'Harvey Dale'];
        foreach($demo_residents as $str) {
            $items = explode(' ', $str);
            $last = array_pop($items);
            $first = implode(' ', $items);
            
            $resident = new Resident();
            $resident->resident_first_name = $first;
            $resident->resident_last_name = $last;
            $residentsModel->save($resident);
        }
        // $data = [
        //     'username' => 'darth',
        //     'email'    => 'darth@theempire.com',
        // ];

        // // Simple Queries
        // $this->db->query("INSERT INTO users (username, email) VALUES(:username:, :email:)",
        //     $data
        // );

        // // Using Query Builder
        // $this->db->table('users')->insert($data);
    }
}
