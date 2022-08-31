<?php

namespace Tests\Feature\App\Http\Controllers\Posts;

use Tests\TestCase;

class ListPostsControllerTest extends TestCase
{
    public function test_it_works() : void
    {
        $this
            ->get(route('posts.index'))
            ->assertOk()
            ->assertViewIs('posts.index')
        ;
    }
}
