<?php

namespace Tests\Feature\App\Http\Livewire;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Comment;

class CommentTest extends TestCase
{
    public function test_it_allows_user_to_delete_own_comment() : void
    {
        $user = User::factory()->create();

        $post = Post::factory()->forUser()->create();

        $comment = Comment::factory()->for($user)->for($post)->create();

        $this->actingAs($user);

        Livewire::test(\App\Http\Livewire\Comment::class, ['comment' => $comment])
            ->assertSet('comment', $comment)
            ->call('removeComment')
            ->assertOk()
            ->assertEmittedUp('comment.deleted');

        $this->assertSoftDeleted($comment);
    }

    public function test_it_disallows_users_to_delete_others_comments() : void
    {
        $post = Post::factory()->forUser()->create();

        $comment = Comment::factory()->forUser()->for($post)->create();

        $this->actingAs(User::factory()->create());

        Livewire::test(\App\Http\Livewire\Comment::class, ['comment' => $comment])
            ->assertSet('comment', $comment)
            ->call('removeComment')
            ->assertForbidden()
            ->assertNotEmitted('comment.deleted');

        $this->assertNotSoftDeleted($comment);
    }

    public function test_it_disallows_guests_to_delete_others_comments() : void
    {
        $post = Post::factory()->forUser()->create();

        $comment = Comment::factory()->forUser()->for($post)->create();

        $this->assertGuest();

        Livewire::test(\App\Http\Livewire\Comment::class, ['comment' => $comment])
            ->assertSet('comment', $comment)
            ->call('removeComment')
            ->assertForbidden()
            ->assertNotEmitted('comment.deleted');

        $this->assertNotSoftDeleted($comment);
    }
}
