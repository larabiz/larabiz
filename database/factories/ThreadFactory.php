<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Thread>
 */
class ThreadFactory extends Factory
{
    public function definition() : array
    {
        return [
            'title' => fake()->sentence(),
            'content' => fake()->paragraph(),
            'last_activity_at' => now(),
        ];
    }
}
