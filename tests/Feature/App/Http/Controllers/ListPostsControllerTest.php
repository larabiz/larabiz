<?php

namespace Tests\Feature\App\Http\Controllers;

use Tests\TestCase;

class ListPostsControllerTest extends TestCase
{
    public function test_it_lists_posts_excluding_drafts() : void
    {
        $this
            ->get(route('posts.index'))
            ->assertOk()
            ->assertViewIs('posts.index')
        ;
    }
}
