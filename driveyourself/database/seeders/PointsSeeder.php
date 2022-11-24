<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Point;
use Illuminate\Database\Seeder;

class PointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Point::truncate();
        $csvData = fopen(base_path('database/csv/points-data.csv'), 'r');
        $transRow = true;
        while(($data = fgetcsv($csvData, 555, ',')) !== false){
            if(!$transRow){
                Point::create([
                   'name'  => $data[0]
                ]);
            }
            $transRow = false;
        }
        fclose($csvData);
    }
}
