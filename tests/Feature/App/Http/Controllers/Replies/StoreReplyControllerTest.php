<?php

namespace Tests\Feature\App\Http\Controllers\Replies;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;

class StoreReplyControllerTest extends TestCase
{
    public function test_it_stores_replies() : void
    {
        $user = User::factory()->create();

        $thread = Thread::factory()->forUser()->create();

        $this->assertDatabaseCount(Reply::class, 0);

        $this
            ->actingAs($user)
            ->postJson(route('threads.replies.store', $thread), $attributes = [
                'content' => fake()->paragraph(),
            ])
            ->assertRedirect()
        ;

        $this->assertDatabaseHas(Reply::class, $attributes + [
            'user_id' => $user->id,
            'thread_id' => $thread->id,
        ]);
    }

    public function test_it_needs_content() : void
    {
        $user = User::factory()->create();

        $thread = Thread::factory()->forUser()->create();

        $this
            ->actingAs($user)
            ->postJson(route('threads.replies.store', $thread))
            ->assertInvalid(['content' => 'required'])
        ;
    }

    public function test_it_needs_3_or_more_characters_in_content() : void
    {
        $user = User::factory()->create();

        $thread = Thread::factory()->forUser()->create();

        $this
            ->actingAs($user)
            ->postJson(route('threads.replies.store', $thread), $attributes = [
                'content' => 'Fo',
            ])
            ->assertInvalid('content')
        ;
    }
}
