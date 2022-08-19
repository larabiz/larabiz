<?php

namespace Tests\Feature\App\Actions\Fortify;

use Tests\TestCase;
use App\Models\User;
use App\Actions\Fortify\ResetUserPassword;

class ResetUserPasswordTest extends TestCase
{
    public function test_it_resets_password() : void
    {
        $user = User::factory()->create();

        $old = $user->password;

        (new ResetUserPassword)->reset($user, [
            'password' => 'some-new-password',
            'password_confirmation' => 'some-new-password',
        ]);

        $this->assertNotEquals($old, $user->password);
    }
}
