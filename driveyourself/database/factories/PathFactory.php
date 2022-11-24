<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\PathType;
use App\Models\ExaminationCenter;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Path>
 */
class PathFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake() -> unique() -> word(),
            'duration' => fake() -> numberBetween(0, 60),
            'distance' => fake() -> randomNumber(4, false),
            'level' => fake() -> numberBetween(1, 3),
            'path_type_id' => PathType::factory(),
            'examination_center_id' => ExaminationCenter::factory(),
        ];
    }
}
