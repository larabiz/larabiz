<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Thread;
use App\Http\Middleware\VerifyCsrfToken;

class ForumTest extends TestCase
{
    public function test_forum_routes_are_disabled_in_production() : void
    {
        $thread = Thread::factory()->create();

        app()['env'] = 'production';

        $this
            ->withoutMiddleware(VerifyCsrfToken::class)
            ->actingAs(User::factory()->create())
        ;

        $this
            ->getJson(route('threads.index'))
            ->assertForbidden()
        ;

        $this
            ->getJson(route('threads.create'))
            ->assertForbidden()
        ;

        $this
            ->postJson(route('threads.store'))
            ->assertForbidden()
        ;

        $this
            ->getJson(route('threads.show', [$thread->random_id, $thread->slug]))
            ->assertForbidden()
        ;

        $this
            ->postJson(route('threads.replies.store', [$thread->random_id, $thread->slug]))
            ->assertForbidden()
        ;
    }
}
