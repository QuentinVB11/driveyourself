<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Path;
use App\Models\PathType;
use App\Models\Point;
use App\Models\ExaminationCenter;

class PathModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_points_manyToMany_relationship()
    {
        $count = 10;
        $tmp = $count;
        
        $path = Path::factory() -> create();
        while($count-- > 0){
            $point = Point::factory() -> create();
            $path -> points() -> attach($point, ['order_number' => $this -> on(2)]);
        }
        
        $count = $tmp;
        $points = $path -> points() -> get();
        $this -> assertEquals($count, count($points));
    }

    public function test_pathType_belongsTo_relationship(){
        $type = PathType::factory() -> create();
        $paths = Path::factory()
            -> count(3)
            -> for($type)
            -> create();
        
        foreach($paths as $path){
            $result = $path -> pathType() -> first();
            $this -> assertTrue($this -> arrayEquals($type, $result, ['id', 'type']));
        }
    }

    public function test_examinationCenter_belongsTo_relationship(){
        $center = ExaminationCenter::factory() -> create();
        $paths = Path::factory()
            -> count(3)
            -> for($center)
            -> create();
        
        foreach($paths as $path){
            $result = $path -> examinationCenter() -> first();
            $this -> assertTrue($this -> arrayEquals($center, $result, ['id', 'name', 'postal_code', 'city']));
        }
    }

    private function arrayEquals($expected, $result, $keys){
        // expected array is assumed to have the keys denoted in $keys
        foreach($keys as $key){
            if($expected -> $key !== $result -> $key)
                return false;
        }

        return true;
    }

    private function on($digits){
        return fake() -> unique() -> randomNumber($digits, false);
    }
}
