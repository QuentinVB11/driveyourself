<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\Point;
use App\Models\Path;

class PointModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_paths_manyToMany_relationship()
    {
        $count = 10;
        $tmp = $count;

        $point = Point::factory() -> create();
        while($count-- > 0){
            $path = Path::factory() -> create();
            $point -> paths() -> attach($path, ['order_number' => $this -> on(2)]);
        }
        
        $count = $tmp;
        $paths = $point -> paths() -> get();
        $this -> assertEquals($count, count($paths));
    }

    private function on($digits){
        return fake() -> unique() -> randomNumber($digits, false);
    }
}
