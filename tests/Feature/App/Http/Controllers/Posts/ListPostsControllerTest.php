<?php

namespace Tests\Feature\App\Http\Controllers\Posts;

use Tests\TestCase;
use Illuminate\Support\Collection;

class ListPostsControllerTest extends TestCase
{
    public function test_it_lists_all_posts() : void
    {
        $response = $this
            ->get(route('posts.index'))
            ->assertOk()
            ->assertViewIs('posts.index')
        ;

        $this->assertInstanceOf(Collection::class, $response->viewData('posts'));
    }
}
