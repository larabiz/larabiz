<?php

namespace Tests\Feature\App\Actions\Fortify;

use Tests\TestCase;
use App\Models\User;
use App\Actions\Fortify\UpdateUserPassword;
use Illuminate\Validation\ValidationException;

class UpdateUserPasswordTest extends TestCase
{
    public function test_it_updates_user_password() : void
    {
        $user = User::factory()->make();

        (new UpdateUserPassword)->update($user, [
            'current_password' => 'password',
            'password' => 'something',
            'password_confirmation' => 'something',
        ]);

        // Make sure the password is hashed.
        $this->assertNotEquals('something', $user->password);
    }

    public function test_it_needs_current_password() : void
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make();

        (new UpdateUserPassword)->update($user, [
            'password' => 'something',
            'password_confirmation' => 'something',
        ]);
    }

    public function test_it_needs_current_password_to_be_right() : void
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make();

        (new UpdateUserPassword)->update($user, [
            'current_password' => 'foo',
            'password' => 'something',
            'password_confirmation' => 'something',
        ]);
    }

    public function test_it_needs_a_password() : void
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make();

        (new UpdateUserPassword)->update($user, [
            'current_password' => 'password',
        ]);
    }

    public function test_it_needs_a_password_confirmation() : void
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->make();

        (new UpdateUserPassword)->update($user, [
            'current' => 'password',
            'password' => 'something',
        ]);
    }
}
