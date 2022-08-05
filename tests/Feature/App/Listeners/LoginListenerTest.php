<?php

namespace Tests\Feature\App\Listeners;

use Tests\TestCase;
use App\Models\User;

class LoginListenerTest extends TestCase
{
    public function test_it_saves_last_login_date() : void
    {
        $user = User::factory()->create();

        $this->assertNull($user->last_login_at);

        auth()->attempt([
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertNotNull($user->fresh()->last_login_at);
    }
}
