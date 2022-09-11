<?php

namespace Tests\Feature\App\Providers;

use Tests\TestCase;
use App\Models\User;

class HorizonServiceProviderTest extends TestCase
{
    public function test_it_allows_some_emails() : void
    {
        $master = User::factory()->master()->create();

        $this
            ->actingAs($master)
            ->getJson('/horizon')
            ->assertOk()
        ;
    }

    public function test_it_disallows_other_users() : void
    {
        $this
            ->actingAs(User::factory()->create())
            ->getJson('/horizon')
            ->assertForbidden()
        ;
    }

    public function test_it_disallows_guests() : void
    {
        $this
            ->assertGuest()
            ->getJson('/horizon')
            ->assertForbidden()
        ;
    }
}
