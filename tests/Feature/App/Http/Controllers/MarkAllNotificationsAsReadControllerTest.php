<?php

namespace Tests\Feature\App\Http\Controllers;

use Tests\TestCase;
use App\Models\User;

class MarkAllNotificationsAsReadControllerTest extends TestCase
{
    public function test_it_works() : void
    {
        $user = User::factory()->create();

        $this
            ->from(route('home'))
            ->actingAs($user)
            ->postJson(route('user.mark-all-notifications-as-read'))
            ->assertRedirect(route('home'))
        ;
    }

    public function test_it_disallows_guests() : void
    {
        $this
            ->assertGuest()
            ->postJson(route('user.mark-all-notifications-as-read'))
            ->assertUnauthorized()
        ;
    }
}
