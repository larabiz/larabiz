<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Thread;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reply>
 */
class ReplyFactory extends Factory
{
    public function definition() : array
    {
        return [
            'user_id' => User::factory(),
            'thread_id' => Thread::factory(),
            'content' => fake()->paragraph(),
        ];
    }
}
