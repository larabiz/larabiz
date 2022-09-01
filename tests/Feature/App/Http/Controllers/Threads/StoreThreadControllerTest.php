<?php

namespace Tests\Feature\App\Http\Controllers\Threads;

use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;

class StoreThreadControllerTest extends TestCase
{
    public function test_it_stores_threads() : void
    {
        $user = User::factory()->create();

        $this->assertDatabaseCount(Thread::class, 0);

        $this
            ->actingAs($user)
            ->postJson(route('threads.store'), $attributes = [
                'title' => fake()->sentence(),
                'content' => fake()->paragraph(),
            ])
            ->assertRedirect()
        ;

        $this->assertDatabaseHas(Thread::class, $attributes + [
            'user_id' => $user->id,
            'last_activity_at' => now(),
        ]);
    }

    public function test_it_disallows_guests_to_store_threads() : void
    {
        $this
            ->assertGuest()
            ->postJson(route('threads.store'))
            ->assertUnauthorized()
        ;
    }

    public function test_it_needs_title() : void
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->postJson(route('threads.store'), $attributes = [
                'content' => fake()->paragraph(),
            ])
            ->assertInvalid(['title' => 'required'])
        ;
    }

    public function test_it_needs_3_or_more_characters_in_title() : void
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->postJson(route('threads.store'), $attributes = [
                'title' => 'Fo',
                'content' => fake()->paragraph(),
            ])
            ->assertInvalid('title')
        ;
    }

    public function test_it_needs_content() : void
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->postJson(route('threads.store'), $attributes = [
                'title' => fake()->sentence(),
            ])
            ->assertInvalid(['content' => 'required'])
        ;
    }

    public function test_it_needs_3_or_more_characters_in_content() : void
    {
        $user = User::factory()->create();

        $this
            ->actingAs($user)
            ->postJson(route('threads.store'), $attributes = [
                'title' => fake()->sentence(),
                'content' => 'Fo',
            ])
            ->assertInvalid('content')
        ;
    }
}
