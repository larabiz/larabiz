<?php

namespace Tests\Feature\App\Http\Controllers\Subscriptions;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Subscription;

class SubscribeToPostControllerTest extends TestCase
{
    public function test_it_subscribes_user_to_a_given_subscribable() : void
    {
        $user = User::factory()->create();

        $post = Post::factory()->published()->create();

        $this->assertDatabaseCount(Subscription::class, 0);

        $this
            ->actingAs($user)
            ->postJson(route('subscribe-to-post', $post))
            ->assertRedirect()
        ;

        // $this->assertDatabaseHas(Subscription::class, [
        //     'user_id' => $user->id,
        //     'subscribable_type' => $post->getMorphClass(),
        //     'subscribable_id' => $post->id,
        // ]);
    }

    public function test_it_does_not_resubscribe_user_to_subscribable() : void
    {
        $user = User::factory()->create();

        $post = Post::factory()->published()->create();

        Subscription::factory()->create([
            'user_id' => $user->id,
            'subscribable_type' => $post->getMorphClass(),
            'subscribable_id' => $post->id,
        ]);

        $this->assertDatabaseCount(Subscription::class, 1);

        $this->assertDatabaseHas(Subscription::class, [
            'user_id' => $user->id,
            'subscribable_type' => $post->getMorphClass(),
            'subscribable_id' => $post->id,
        ]);

        $this
            ->from(route('home'))
            ->actingAs($user)
            ->postJson(route('subscribe-to-post', $post))
            ->assertRedirect(route('home'))
        ;

        $this->assertDatabaseCount(Subscription::class, 1);

        $this->assertDatabaseHas(Subscription::class, [
            'user_id' => $user->id,
            'subscribable_type' => $post->getMorphClass(),
            'subscribable_id' => $post->id,
        ]);
    }
}
