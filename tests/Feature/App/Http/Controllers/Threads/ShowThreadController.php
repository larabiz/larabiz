<?php

namespace Tests\Feature\App\Http\Controllers\Threads;

use Tests\TestCase;
use App\Models\Thread;

class ShowThreadController extends TestCase
{
    public function test_it_shows_threads() : void
    {
        $thread = Thread::factory()->create();

        $this
            ->getJson(route('threads.show', $thread))
            ->assertOk()
        ;
    }
}
