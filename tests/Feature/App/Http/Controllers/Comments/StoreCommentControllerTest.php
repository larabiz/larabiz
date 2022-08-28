<?php

namespace Tests\Feature\App\Http\Controllers\Comments;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Models\Subscription;

class StoreCommentControllerTest extends TestCase
{
    public function test_it_stores_a_comment() : void
    {
        $user = User::factory()->create();

        $post = Post::factory()->forUser()->published()->create();

        $this
            ->from(route('home'))
            ->actingAs($user)
            ->postJson(route('comments.store', $post), [
                'content' => $content = fake()->paragraph(),
                'subscribe' => true,
            ])
            ->assertRedirect(route('home'))
        ;

        $this->assertDatabaseHas(Comment::class, [
            'user_id' => $user->id,
            'content' => $content,
        ]);

        $this->assertDatabaseHas(Subscription::class, [
            'user_id' => $user->id,
            'subscribable_type' => $post->getMorphClass(),
            'subscribable_id' => $post->id,
        ]);
    }

    public function test_it_disallows_guests_to_store_comments() : void
    {
        $post = Post::factory()->forUser()->published()->create();

        $this
            ->assertGuest()
            ->postJson(route('comments.store', $post), ['content' => fake()->paragraph()])
            ->assertUnauthorized()
        ;

        $this->assertDatabaseCount(Comment::class, 0);
    }

    public function test_it_does_not_subscribe_user_to_post() : void
    {
        $user = User::factory()->create();

        $post = Post::factory()->forUser()->published()->create();

        $this
            ->actingAs($user)
            ->postJson(route('comments.store', $post), ['content' => $content = fake()->paragraph()])
            ->assertRedirect()
        ;

        $this->assertDatabaseCount(Subscription::class, 0);
    }
}
