<?php

namespace Tests\Feature\App\Http\Controllers\Posts;

use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Collection;

class ShowPostControllerTest extends TestCase
{
    public function test_it_shows_a_post() : void
    {
        $shown = Post::factory()->forUser()->published()->create();

        $this
            ->get(route('posts.show', [$shown->random_id, $shown->slug]))
            ->assertOk()
            ->assertViewIs('posts.show')
            ->assertSee('Publié le')
        ;
    }

    public function test_it_shows_other_posts_to_read() : void
    {
        Post::factory(10)->forUser()->published()->create();

        $shown = Post::inRandomOrder()->first();

        $response = $this
            ->get(route('posts.show', [$shown->random_id, $shown->slug]))
            ->assertOk()
        ;

        /** @var \Illuminate\Support\Collection */
        $latest = $response->viewData('others');

        $this->assertInstanceOf(Collection::class, $latest);
        $this->assertCount(6, $latest);
        $this->assertTrue($latest->doesntContain('id', $shown->id));
        $this->assertTrue(1 !== $latest[0]->id || 2 !== $latest[1]->id || 3 !== $latest[2]->id || 4 !== $latest[3]->id || 5 !== $latest[4]->id || 6 !== $latest[5]->id);
    }

    public function test_it_shows_drafts_to_master() : void
    {
        $post = Post::factory()->forUser()->create();

        $this
            ->actingAs(User::master()->first())
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
