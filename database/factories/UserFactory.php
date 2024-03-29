<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition() : array
    {
        $username = fake()->userName();

        $slug = str($username)->slug('.');

        return [
            'username' => $username,
            'github' => "https://github.com/$slug",
            'linkedin' => "https://www.linkedin.com/in/$slug",
            'biography' => fake()->paragraph(),
            'email' => "$slug@example.com",
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    public function master() : static
    {
        return $this->state(fn () => ['email' => config('app.master_email')]);
    }

    public function unverified() : static
    {
        return $this->state(fn () => ['email_verified_at' => null]);
    }
}
