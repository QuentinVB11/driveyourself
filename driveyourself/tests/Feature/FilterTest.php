<?php

namespace Tests\Feature;

use App\Models\Path;
use App\Models\PathType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FilterTest extends TestCase
{
   use RefreshDatabase;

       /**
     * A basic feature test example.
     *
     * @return void
     */

    public function create_path_types(){
        $type1 = PathType::factory()->create([
            'id' => '1'
        ]);
        $type2 = PathType::factory()->create([
            'id' => '2'
        ]);
        $type3 = PathType::factory()->create([
            'id' => '3'
        ]);

        $path = Path::factory()->count(10)->create([
            'path_type_id' => '1'
        ]);

        $path2 = Path::factory()->count(20)->create([
            'path_type_id' => '2'
        ]);

        $path3 = Path::factory()->count(30)->create([
            'path_type_id' => '3'
        ]);
    }


    public function create_paths_level(){

        $path = Path::factory()->count(10)->create([
            'level' => '1'
        ]);

        $path2 = Path::factory()->count(20)->create([
            'level' => '2'
        ]);

        $path3 = Path::factory()->count(30)->create([
            'level' => '3'
        ]);
    }

    public function create_paths_duration(){

        $path = Path::factory()->count(10)->create([
            'duration' => '1'
        ]);

        $path2 = Path::factory()->count(20)->create([
            'duration' => '2'
        ]);

        $path3 = Path::factory()->count(30)->create([
            'duration' => '3'
        ]);
    }


    public function test_type_filter()
    {

        $this->create_path_types();

        $response = Path::getPathByType(3);

        $this->assertEquals(30, count($response));
    }


    public function test_type_filter_false()
    {

        $this->create_path_types();

        $response = Path::getPathByType(3);

        $this->assertFalse(22 == count($response));
    }


    public function test_level_filter()
    {

        $this->create_paths_level();

        $response = Path::getPathByLevel(3);

        $this->assertEquals(30, count($response));
    }

    public function test_level_false()
    {

        $this->create_paths_level();

        $response = Path::getPathByLevel(3);

        $this->assertFalse(22 == count($response));
    }



    public function test_duration_filter()
    {

        $this->create_paths_duration();

        $response = Path::getPathByDuration(3);

        $this->assertEquals(30, count($response));
    }

    public function test_duration_false()
    {

        $this->create_paths_duration();

        $response = Path::getPathByDuration(3);

        $this->assertFalse(22 == count($response));
    }
    


}
