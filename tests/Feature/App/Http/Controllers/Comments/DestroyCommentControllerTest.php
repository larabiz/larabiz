<?php

namespace Tests\Feature\App\Http\Controllers\Comments;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class DestroyCommentControllerTest extends TestCase
{
    public function test_it_deletes_a_given_comment() : void
    {
        $post = Post::factory()->forUser()->create();

        $comment = Comment::factory()->forUser()->for($post)->create();

        $this
            ->from(route('home'))
            ->actingAs($comment->user)
            ->deleteJson(route('comments.destroy', $comment))
            ->assertRedirect(route('home'))
        ;

        $this->assertSoftDeleted($comment);
    }

    public function test_it_disallows_users_to_delete_others_comment() : void
    {
        $post = Post::factory()->forUser()->create();

        $comment = Comment::factory()->forUser()->for($post)->create();

        $this
            ->actingAs(User::factory()->create())
            ->deleteJson(route('comments.destroy', $comment))
            ->assertForbidden()
        ;

        $this->assertNotSoftDeleted($comment);
    }

    public function test_it_guests_to_delete_comments() : void
    {
        $post = Post::factory()->forUser()->create();

        $comment = Comment::factory()->forUser()->for($post)->create();

        $this
            ->assertGuest()
            ->deleteJson(route('comments.destroy', $comment))
            ->assertUnauthorized()
        ;

        $this->assertNotSoftDeleted($comment);
    }
}
