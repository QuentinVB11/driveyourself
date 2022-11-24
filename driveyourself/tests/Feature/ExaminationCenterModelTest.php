<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase; 
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\ExaminationCenter;
use App\Models\Path;

class ExaminationCenterTest extends TestCase
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
        $center = ExaminationCenter::factory()
            -> has(Path::factory() -> count($count))
            -> create();

        $paths = $center -> paths() -> get();
        $this -> assertEquals($count, count($paths));
    }
}
