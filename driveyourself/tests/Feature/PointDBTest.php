<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Point;

class PointDBTest extends TestCase
{
    use RefreshDatabase;

    public function test_point_db_read()
    {
        //The factory (fake)  5 points
        $points = Point::factory()->count(5)->create();

        foreach($points as $point){
            $this->assertModelExists($point);
        }

        //Check if the database has 5 examination centers 
        $this->assertDatabaseCount('points', 5);
    }

    public function test_db_point_delete()
    {

        //Create the points
        $points = Point::factory()->create();

        //Delete the row in the database.
        $points ->delete();

        //Check if the row is correctly deleted (soft here)
        $this->assertDatabaseMissing('paths',['id' => $points->id]);
        $this->assertModelMissing($points);
    }
}
