<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class RegisterTest extends TestCase
{
    public function test_it_works() : void
    {
        $this
            ->assertGuest()
            ->get(route('register'))
            ->assertOk()
        ;
    }

    public function test_it_disallows_users() : void
    {
        $this
            ->actingAs(User::factory()->create())
            ->getJson(route('register'))
            ->assertRedirect()
        ;
    }
}
