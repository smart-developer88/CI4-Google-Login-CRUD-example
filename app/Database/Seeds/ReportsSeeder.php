<?php namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Entities\Report;
use App\Models\ReportsModel;

class ReportsSeeder extends Seeder
{
    public function run()
    {
        $COUNT_HOUSES = 3;
        $COUNT_RESIDENTS = 4;

        $reportsModel = new ReportsModel();
        $demo_reports = [
            [
                'shift_date' => '2020-08-01',
                'shift_timing' => 'Morning',
                'reporter_name' => 'Jenny',
            ],
            [
                'shift_date' => '2020-08-01',
                'shift_timing' => 'Afternoon',
                'reporter_name' => 'Anthony',
            ],
            [
                'shift_date' => '2020-08-01',
                'shift_timing' => 'Evening',
                'reporter_name' => 'Karl',
            ],
            [
                'shift_date' => '2020-08-01',
                'shift_timing' => 'Morning',
                'reporter_name' => 'Harold',
            ],
            [
                'shift_date' => '2020-08-01',
                'shift_timing' => 'Afternoon',
                'reporter_name' => 'Lacy',
            ],
            [
                'shift_date' => '2020-08-01',
                'shift_timing' => 'Evening',
                'reporter_name' => 'Lacy',
            ],
            
            [
                'shift_date' => '2020-09-30',
                'shift_timing' => 'Morning',
                'reporter_name' => 'Jenny',
            ],
            [
                'shift_date' => '2020-09-30',
                'shift_timing' => 'Afternoon',
                'reporter_name' => 'Anthony',
            ],
            [
                'shift_date' => '2020-09-30',
                'shift_timing' => 'Evening',
                'reporter_name' => 'Karl',
            ],
            [
                'shift_date' => '2020-09-30',
                'shift_timing' => 'Morning',
                'reporter_name' => 'Harold',
            ],
            [
                'shift_date' => '2020-09-30',
                'shift_timing' => 'Afternoon',
                'reporter_name' => 'Lacy',
            ],
            [
                'shift_date' => '2020-09-30',
                'shift_timing' => 'Evening',
                'reporter_name' => 'Lacy',
            ],
        ];
        foreach($demo_reports as $demo) {
            $report = new Report();
            $report->fill($demo);
            $report->house_id = random_int(1, $COUNT_HOUSES);
            $report->resident_id = random_int(1, $COUNT_RESIDENTS);
            $reportsModel->save($report);
        }
    }
}
