<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class LoginTest extends TestCase
{
    public function test_it_shows_login_form() : void
    {
        $this
            ->assertGuest()
            ->get(route('login'))
            ->assertOk()
        ;
    }

    public function test_it_disallows_users() : void
    {
        $this
            ->actingAs(User::factory()->create())
            ->getJson(route('login'))
            ->assertRedirect()
        ;
    }
}
