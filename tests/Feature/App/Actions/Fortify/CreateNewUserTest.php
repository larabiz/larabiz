<?php

namespace Tests\Feature\App\Actions\Fortify;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Str;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Validation\ValidationException;

class CreateNewUserTest extends TestCase
{
    public function test_it_creates_a_user() : void
    {
        $user = (new CreateNewUser)->create([
            'username' => fake()->name(),
            'email' => fake()->safeEmail(),
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Make sure the password is hashed.
        $this->assertNotEquals('password', $user->password);
    }

    public function test_it_needs_a_username() : void
    {
        $this->expectException(ValidationException::class);

        (new CreateNewUser)->create([
            'email' => fake()->safeEmail(),
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
    }

    public function test_it_needs_an_unique_username() : void
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->create();

        (new CreateNewUser)->create([
            'username' => $user->username,
            'email' => fake()->safeEmail(),
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
    }

    public function test_it_needs_at_least_a_3_characters_username() : void
    {
        $this->expectException(ValidationException::class);

        (new CreateNewUser)->create([
            'username' => Str::random(2),
            'email' => fake()->safeEmail(),
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
    }

    public function test_it_needs_an_email() : void
    {
        $this->expectException(ValidationException::class);

        (new CreateNewUser)->create([
            'username' => fake()->name(),
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
    }

    public function test_it_needs_an_unique_email() : void
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->create();

        (new CreateNewUser)->create([
            'username' => fake()->name(),
            'email' => $user->email,
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
    }

    public function test_it_needs_at_least_a_valid_email() : void
    {
        $this->expectException(ValidationException::class);

        (new CreateNewUser)->create([
            'username' => fake()->name(),
            'email' => 'foo',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);
    }

    public function test_it_needs_a_password() : void
    {
        $this->expectException(ValidationException::class);

        (new CreateNewUser)->create([
            'username' => fake()->name(),
            'email' => fake()->safeEmail(),
        ]);
    }

    public function test_it_needs_a_password_confirmation() : void
    {
        $this->expectException(ValidationException::class);

        (new CreateNewUser)->create([
            'username' => fake()->name(),
            'email' => fake()->safeEmail(),
            'password' => 'password',
        ]);
    }
}
