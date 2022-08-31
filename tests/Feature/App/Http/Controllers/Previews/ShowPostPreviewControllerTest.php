<?php

namespace Tests\Feature\App\Http\Controllers\Previews;

use Tests\TestCase;
use App\Models\Post;

class ShowPostPreviewControllerTest extends TestCase
{
    public function test_it_shows_a_post_preview_even_if_unpublished() : void
    {
        $post = Post::factory()->forUser()->create();

        $this
            ->get(route('previews.post', [$post->random_id]))
            ->assertOk()
            ->assertViewIs('previews.post')
        ;
    }
}
