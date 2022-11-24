<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExaminationCenter>
 */
class ExaminationCenterFactory extends Factory
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
            'postal_code' => fake() -> randomNumber(4, true) ,
            'city' => fake() -> city(),
        ];
    }
}
