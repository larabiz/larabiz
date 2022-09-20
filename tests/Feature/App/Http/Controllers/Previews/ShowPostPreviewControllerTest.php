<?php

namespace Tests\Feature\App\Http\Controllers\Previews;

use Tests\TestCase;
use App\Models\Post;

class ShowPostPreviewControllerTest extends TestCase
{
    public function test_it_shows_a_post_preview() : void
    {
        $post = Post::factory()->published()->create();

        $this
            ->getJson(route('previews.post', $post->random_id))
            ->assertOk()
            ->assertViewIs('previews.post')
        ;
    }
}
