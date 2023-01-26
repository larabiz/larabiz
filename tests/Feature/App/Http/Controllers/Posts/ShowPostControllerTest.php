<?php

namespace Tests\Feature\App\Http\Controllers\Posts;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Support\Collection;

class ShowPostControllerTest extends TestCase
{
    public function test_it_shows_a_given_post() : void
    {
        $post = Post::factory()->published()->create();

        $this
            ->get(route('posts.show', $post))
            ->assertOk()
            ->assertViewIs('posts.show')
        ;
    }

    public function test_it_shows_other_posts_to_read() : void
    {
        Post::factory(10)->published()->create();

        $post = Post::inRandomOrder()->first();

        $response = $this
            ->get(route('posts.show', $post))
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
}
