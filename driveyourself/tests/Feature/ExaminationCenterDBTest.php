<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\ExaminationCenter;

class ExaminationCenterDBTest extends TestCase
{

    use RefreshDatabase;

    public function test_exam_center_db_read()
    {
        //The factory (fake) exam center 5 exams
        $exams = ExaminationCenter::factory()->count(5)->create();

        foreach($exams as $exam){
            $this->assertModelExists($exam);
        }

        //Check if the database has 5 examination centers 
        $this->assertDatabaseCount('examination_centers', 5);
    }

    public function test_db_exam_center_delete()
    {

        //Create the exam center 
        $exam = ExaminationCenter::factory()->create();


        //Delete the row in the database.
        $exam ->delete();

        //Check if the row is correctly deleted (soft here)
        $this->assertSoftDeleted($exam);
    }

    public function test_db_exam_center_force_delete()
    {

        //Create the exam center 
        $exam = ExaminationCenter::factory()->create();

        //Force Delete the row in the database.
        $exam ->forceDelete();

        //Check if the row is correctly deleted (forcing delete here)
        $this->assertDatabaseMissing('examination_centers',['id' => $exam->id]);
        $this->assertModelMissing($exam);
    }
}
