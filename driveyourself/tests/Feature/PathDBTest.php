<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Path;

class PathDBTest extends TestCase
{
    use RefreshDatabase;

    
    public function test_path_db_read()
    {
        //The factory (fake)  5 paths
        $paths = Path::factory()->count(5)->create();
        foreach($paths as$path){
            $this->assertModelExists($path);
        }

        //Check if the database has 5 examination centers 
        $this->assertDatabaseCount('paths', 5);
    }

    public function test_db_path_model_is_missing()
    {
        //Create the paths
        $path =  Path::factory()->create();

        $path->delete();

        $this->assertModelMissing($path);
        $this->assertDatabaseMissing('paths',['id' => $path->id]);
    }

   
}
