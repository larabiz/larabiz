<?php

namespace Tests\Feature\App\Http\Controllers;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;

class ShowCommentControllerTest extends TestCase
{
    public function test_it_shows_comments() : void
    {
        $user = User::factory()->create();

        $post = Post::factory()->forUser()->has(
            Comment::factory(10)->forUser()
        )->create();

        $comment = $post->comments->first();

        $response = $this
            ->actingAs($user)
            ->getJson(route('posts.comments.show', $comment->random_id))
            ->assertOk()
            ->assertViewIs('comments.show')
        ;

        $this->assertInstanceOf(Comment::class, $response->viewData('comment'));
    }
}
