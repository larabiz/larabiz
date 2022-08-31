<?php

namespace Tests\Feature\App\Http\Controllers\User;

use Tests\TestCase;
use App\Models\User;

class ManageSubscriptionsControllerTest extends TestCase
{
    public function test_it_works() : void
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->getJson(route('user-subscriptions'))
            ->assertOk()
            ->assertViewIs('user.subscriptions')
        ;
    }

    public function test_it_disallows_guests() : void
    {
        $this
            ->assertGuest()
            ->getJson(route('user-subscriptions'))
            ->assertUnauthorized()
        ;
    }
}
