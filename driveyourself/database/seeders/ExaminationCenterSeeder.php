<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ExaminationCenter;

class ExaminationCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ExaminationCenter::truncate();

        $csvData = fopen(base_path('database/csv/centre-examen-prj.csv'), 'r');
        $transrow = true;
        while(($data = fgetcsv($csvData, 555, ',')) != false){
            if(!$transrow){
                ExaminationCenter::create([
                    'name' => $data[0],
                    'postal_code' => $data[1],
                    'city' => $data[2],

                ]);
            }
            $transrow = false;
        }
        fclose($csvData);


    }
}
