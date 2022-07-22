<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discussion>
 */
class DiscussionFactory extends Factory
{
    public function definition() : array
    {
        return [
            'title' => fake()->sentence(),

            'content' => fake()->paragraph(),
        ];
    }
}
