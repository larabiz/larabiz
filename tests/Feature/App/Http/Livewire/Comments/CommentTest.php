<?php

namespace Tests\Feature\App\Http\Livewire\Comments;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Comment;

class CommentTest extends TestCase
{
    public function test_it_deletes_comment() : void
    {
        $comment = Comment::factory()->forUser()->for(
            Post::factory()->forUser()->create()
        )->create();

        $this->actingAs($comment->user);

        Livewire::test(\App\Http\Livewire\Comments\Comment::class, compact('comment'))
            ->assertSet('comment', $comment)
            ->call('delete')
            ->assertOk()
            ->assertEmittedUp('comment.deleted');

        $this->assertSoftDeleted($comment);
    }

    public function test_it_allows_master_to_delete_any_comment() : void
    {
        $comment = Comment::factory()->forUser()->for(
            Post::factory()->forUser()->create()
        )->create();

        $this->actingAs(User::master()->first());

        Livewire::test(\App\Http\Livewire\Comments\Comment::class, compact('comment'))
            ->call('delete')
            ->assertOk();
    }

    public function test_it_disallows_users_to_delete_other_users_comment() : void
    {
        $comment = Comment::factory()->forUser()->for(
            Post::factory()->forUser()->create()
        )->create();

        $this->actingAs(User::factory()->create());

        Livewire::test(\App\Http\Livewire\Comments\Comment::class, compact('comment'))
            ->call('delete')
            ->assertForbidden();
    }

    public function test_it_disallows_guests_to_delete_comment() : void
    {
        $comment = Comment::factory()->forUser()->for(
            Post::factory()->forUser()->create()
        )->create();

        $this->assertGuest();

        Livewire::test(\App\Http\Livewire\Comments\Comment::class, compact('comment'))
            ->call('delete')
            ->assertForbidden();
    }
}
