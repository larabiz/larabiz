<?php

namespace Tests\Feature\App\Http\Controllers\Posts;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Collection;

class ShowPostControllerTest extends TestCase
{
    public function test_it_shows_a_given_post() : void
    {
        $shown = Post::factory()->forUser()->published()->create();

        $this
            ->get(route('posts.show', [$shown->random_id, $shown->slug]))
            ->assertOk()
            ->assertViewIs('posts.show')
        ;
    }

    public function test_it_shows_other_posts_to_read() : void
    {
        Post::factory(10)->forUser()->published()->create();

        $post = Post::inRandomOrder()->first();

        $response = $this
            ->get(route('posts.show', [$post->random_id, $post->slug]))
            ->assertOk()
        ;

        /** @var \Illuminate\Support\Collection */
        $others = $response->viewData('others');

        $this->assertInstanceOf(Collection::class, $others);
        $this->assertCount(6, $others);
        // Make sure the post isn't among the recommended posts.
        $this->assertTrue($others->doesntContain('id', $post->id));
        // Make sure the posts are in random order.
        $this->assertTrue(1 !== $others[0]->id || 2 !== $others[1]->id || 3 !== $others[2]->id || 4 !== $others[3]->id || 5 !== $others[4]->id || 6 !== $others[5]->id);
    }

    public function test_it_shows_drafts_to_master() : void
    {
        $master = User::factory()->master()->create();

        $post = Post::factory()->forUser()->create();

        $this
            ->actingAs($master)
            ->get(route('posts.show', [$post->random_id, $post->slug]))
            ->assertOk()
            ->assertSee('Brouillon')
        ;
    }

    public function test_it_does_not_show_drafts_to_guests() : void
    {
        $post = Post::factory()->forUser()->create();

        $this
            ->assertGuest()
            ->get(route('posts.show', [$post->random_id, $post->slug]))
            ->assertNotFound()
        ;
    }

    public function test_it_does_not_show_drafts_to_users() : void
    {
        $post = Post::factory()->forUser()->create();

        $this
            ->actingAs(User::factory()->create())
            ->get(route('posts.show', [$post->random_id, $post->slug]))
            ->assertNotFound()
        ;
    }

    public function test_it_redirects_when_slug_is_wrong() : void
    {
        $post = Post::factory()->forUser()->published()->create();

        $this
            ->get(route('posts.show', [$post->random_id, 'foo']))
            ->assertStatus(301)
            ->assertLocation(route('posts.show', [$post->random_id, $post->slug]))
        ;
    }
}
