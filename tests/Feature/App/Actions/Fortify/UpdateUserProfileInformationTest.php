<?php

namespace Tests\Feature\App\Actions\Fortify;

use Tests\TestCase;
use App\Models\User;
use App\Actions\Fortify\UpdateUserProfileInformation;

class UpdateUserProfileInformationTest extends TestCase
{
    public function test_it_updates_a_user() : void
    {
        $user = User::factory()->make();

        (new UpdateUserProfileInformation)->update($user, $attributes = [
            'username' => fake()->name(),
            'github' => 'https://github.com/' . fake()->userName(),
            'linkedin' => 'https://www.linkedin.com/in/' . fake()->name(),
            'biography' => fake()->paragraph(),
            'email' => fake()->safeEmail(),
        ]);

        $this->assertDatabaseHas(User::class, $attributes);
    }
}
