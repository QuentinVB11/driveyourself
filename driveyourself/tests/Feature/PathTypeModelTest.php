<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\PathType;
use App\Models\Path;

class PathTypeModelTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_paths_hasMany_relationship()
    {
        $count = 10;
        $type = PathType::factory() 
            -> has(Path::factory() -> count($count)) 
            -> create();

        $paths = $type -> paths() -> get();
        $this -> assertEquals($count, count($paths));
    }
}
