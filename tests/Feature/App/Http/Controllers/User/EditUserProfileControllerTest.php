<?php

namespace Tests\Feature\App\Http\Controllers\User;

use Tests\TestCase;
use App\Models\User;

class EditUserProfileControllerTest extends TestCase
{
    public function test_it_works() : void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->getJson(route('user-profile'))
            ->assertOk()
            ->assertViewIs('user.profile')
        ;

        $this->assertEquals($response->viewData('user'), $user);
    }

    public function test_it_disallows_guests() : void
    {
        $this
            ->assertGuest()
            ->getJson(route('user-profile'))
            ->assertUnauthorized()
        ;
    }
}
