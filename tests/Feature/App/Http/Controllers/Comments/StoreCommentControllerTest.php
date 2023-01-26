<?php

namespace Tests\Feature\App\Http\Controllers\Comments;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use App\Events\Commented;
use App\Models\Subscription;
use Illuminate\Support\Facades\Event;

class StoreCommentControllerTest extends TestCase
{
    public function test_it_stores_a_comment() : void
    {
        Event::fake(Commented::class);

        $user = User::factory()->create();

        $post = Post::factory()->published()->create();

        $this
            ->from(route('home'))
            ->actingAs($user)
            ->postJson(route('posts.comments.store', $post), [
                'content' => $content = fake()->paragraph(),
                'subscribe' => true,
            ])
            ->assertRedirect(
                route('posts.show', [$post, 'page' => 1]) . '#comments'
            )
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

        Event::assertDispatched(Commented::class);
    }

    public function test_it_disallows_guests_to_store_comments() : void
    {
        $post = Post::factory()->published()->create();

        $this
            ->assertGuest()
            ->postJson(route('posts.comments.store', $post), ['content' => fake()->paragraph()])
            ->assertUnauthorized()
        ;

        $this->assertDatabaseCount(Comment::class, 0);
    }

    public function test_it_does_unsubscribes_when_field_is_not_filled() : void
    {
        $user = User::factory()->create();

        $post = Post::factory()->published()->create();

        $subscription = $user->subscribeTo($post);

        $this->assertDatabaseHas(Subscription::class, $subscription->toArray());

        $this
            ->actingAs($user)
            ->postJson(route('posts.comments.store', $post), ['content' => fake()->paragraph()])
            ->assertRedirect()
        ;

        $this->assertSoftDeleted($subscription);
    }
}
