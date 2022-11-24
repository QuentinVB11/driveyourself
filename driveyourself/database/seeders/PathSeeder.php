<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Path;

class PathSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Path::truncate();

        $csvData = fopen(base_path('database/csv/chemin-prj.csv'), 'r');
        $transrow = true;
        while(($data = fgetcsv($csvData, 555, ',')) != false){
            if(!$transrow){
                Path::create([
                    'name' => $data[0],
                    'duration'=> 0, //TODO
                    'distance'=> 0, //TODO
                    'level'=> 0, //TODO
                    'path_type_id'=> 1, //TODO
                    'examination_center_id'=>$data[1],


                ]);
            }
            $transrow = false;
        }
        fclose($csvData);
    }
}
