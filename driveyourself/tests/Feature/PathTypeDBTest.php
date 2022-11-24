<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\PathType;

class PathTypeDBTest extends TestCase
{
    use RefreshDatabase;

    public function test_db_path_types_read()
    {
        //The factory (fake)  5 path types in the db 
        $path_types = PathType::factory()->count(5)->create();

        foreach($path_types as $path_type){
            $this->assertModelExists($path_type);
        }

        //Check if the database has 5 examination centers 
        $this->assertDatabaseCount('path_types', 5);
    }

    public function test_db_path_types_delete()
    {

        //Create the path types
        $path_types = PathType::factory()->create();


        //Delete the row in the database.
        $path_types ->delete();

        //Check if the row is correctly deleted (soft here)
        $this->assertSoftDeleted($path_types);
    }

    public function test_db_path_type_force_delete()
    {

        //Create the path types
        $path_types = PathType::factory()->create();


        //Force Delete the row in the database.
        $path_types ->forceDelete();

        //Check if the row is correctly deleted (forcing delete here)
        $this->assertDatabaseMissing('path_types',['id' => $path_types->id]);
        $this->assertModelMissing($path_types);

    }
}
