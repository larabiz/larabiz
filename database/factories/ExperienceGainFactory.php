<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExperienceGain>
 */
class ExperienceGainFactory extends Factory
{
    public function definition() : array
    {
        return [
            'points' => mt_rand(10, 1000),
            'message' => fake()->sentence(),
        ];
    }
}
