<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

use App\Entities\House;
use App\Models\HousesModel;

class HousesSeeder extends Seeder
{
    public function run()
    {
        $housesModel = new HousesModel();
        $demo_houses = ['Serenity', 'Hope', 'Robson'];
        foreach($demo_houses as $str) {
            $house = new House();
            $house->house_name = $str;
            $housesModel->save($house);
        }
    }
}
