<?php

namespace Tests\Feature\App\Http\Controllers\Threads;

use Tests\TestCase;
use App\Models\User;

class CreateThreadControllerTest extends TestCase
{
    public function test_it_shows_threads_form() : void
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->getJson(route('threads.create'))
            ->assertOk()
        ;
    }

    public function test_it_disallows_guests_to_see_threads_form() : void
    {
        $this
            ->assertGuest()
            ->getJson(route('threads.create'))
            ->assertUnauthorized()
        ;
    }
}
