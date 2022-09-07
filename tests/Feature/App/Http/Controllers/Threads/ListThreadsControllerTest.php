<?php

namespace Tests\Feature\App\Http\Controllers\Threads;

use Tests\TestCase;
use App\Models\User;
use App\Models\Reply;
use App\Models\Thread;

class ListThreadsControllerTest extends TestCase
{
    public function test_it_works() : void
    {
        Thread::factory(15)->forUser()->create();

        $response = $this
            ->getJson(route('threads.index'))
            ->assertOk()
            ->assertViewIs('threads.index')
        ;

        $this->assertCount(10, $response->viewData('threads'));
    }

    public function test_it_filters_threads_from_authenticated_user() : void
    {
        $user = User::factory()->create();

        Thread::factory(5)->for($user)->create();

        Thread::factory(5)->forUser()->create();

        $response = $this
            ->actingAs($user)
            ->getJson(route('threads.index', ['filter_by' => 'my_threads']))
            ->assertOk()
            ->assertViewIs('threads.index')
        ;

        $this->assertCount(5, $response->viewData('threads'));
    }

    public function test_it_filters_threads_without_replies() : void
    {
        Thread::factory(5)->forUser()->create();

        Thread::factory(5)->forUser()->has(Reply::factory()->forUser())->create();

        $response = $this
            ->getJson(route('threads.index', ['filter_by' => 'no_reply']))
            ->assertOk()
            ->assertViewIs('threads.index')
        ;

        $this->assertCount(5, $response->viewData('threads'));
    }

    public function test_it_filters_resolved_threads() : void
    {
        $thread = Thread::factory()->forUser()->create();

        $reply = Reply::factory()->forUser()->for($thread)->create();

        $thread->markAsResolved($reply);

        Thread::factory()->forUser()->create();

        $response = $this
            ->getJson(route('threads.index', ['filter_by' => 'resolved']))
            ->assertOk()
            ->assertViewIs('threads.index')
        ;

        $this->assertCount(1, $response->viewData('threads'));
    }

    public function test_it_filters_unresolved_threads() : void
    {
        Thread::factory(5)->forUser()->create(['resolved_by' => 1]);

        Thread::factory(5)->forUser()->create();

        $response = $this
            ->getJson(route('threads.index', ['filter_by' => 'unresolved']))
            ->assertOk()
            ->assertViewIs('threads.index')
        ;

        $this->assertCount(5, $response->viewData('threads'));
    }
}
