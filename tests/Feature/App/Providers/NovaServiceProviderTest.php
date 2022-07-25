<?php

namespace Tests\Feature\App\Providers;

use Tests\TestCase;
use App\Models\User;

class NovaServiceProviderTest extends TestCase
{
    public function test_it_allows_some_emails() : void
    {
        $user = User::factory()->create([
            'email' => 'benjamincrozat@me.com',
        ]);

        $this
            ->actingAs($user)
            ->getJson('/nova')
            ->assertRedirect('/nova/dashboards/main')
        ;
    }

    public function test_it_disallows_other_users() : void
    {
        $this
            ->actingAs(User::factory()->create())
            ->getJson('/nova')
            ->assertForbidden()
        ;
    }

    public function test_it_disallows_guests() : void
    {
        $this
            ->assertGuest()
            ->getJson('/nova')
            ->assertUnauthorized()
        ;
    }
}
