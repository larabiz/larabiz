<?php

namespace Tests\Feature;

use App\Models\Post;
use Tests\TestCase;
use App\Models\User;

class FeedTest extends TestCase
{
    public function test_all_feeds_work_without_errors() : void
    {
        Post::factory(5)->forUser()->published()->create();

        foreach (config('feed.feeds') as $feed) {
            $this
                ->get($feed['url'])
                ->assertOk();
        }
    }
}
