<?php

namespace Tests\Feature\App\Http\Controllers\Subscriptions;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use App\Models\Subscription;

class UnsubscribeFromPostControllerTest extends TestCase
{
    public function test_it_unsubscribes_user_from_a_given_subscribable() : void
    {
        $user = User::factory()->create();

        $post = Post::factory()->forUser()->published()->create();

        $subscription = Subscription::factory()->create([
            'user_id' => $user->id,
            'subscribable_type' => $post->getMorphClass(),
            'subscribable_id' => $post->id,
        ]);

        $this
            ->from(route('home'))
            ->actingAs($user)
            ->postJson(route('unsubscribe-from-post', $post))
            ->assertRedirect(route('home'))
        ;

        $this->assertSoftDeleted($subscription);
    }

    public function test_it_silently_fails_when_user_is_already_unsubscribed_from_subscribable() : void
    {
        $user = User::factory()->create();

        $post = Post::factory()->forUser()->published()->create();

        $this
            ->from(route('home'))
            ->actingAs($user)
            ->postJson(route('unsubscribe-from-post', $post))
            ->assertRedirect(route('home'))
        ;
    }
}
