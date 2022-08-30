<?php

namespace Tests\Feature\App\Http\Controllers;

use Tests\TestCase;
use App\Models\User;

class EditUserPasswordControllerTest extends TestCase
{
    public function test_it_works() : void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            // This is how we can bypass the password.confirm middleware.
            ->session(['auth.password_confirmed_at' => time()])
            ->getJson(route('user-password'))
            ->assertOk()
            ->assertViewIs('user.password')
        ;

        $this->assertEquals($response->viewData('user'), $user);
    }

    public function test_it_disallows_guests() : void
    {
        $this
            ->assertGuest()
            ->getJson(route('user-password'))
            ->assertUnauthorized()
        ;
    }
}
