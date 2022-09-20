<?php

namespace Tests\Feature\App\Console\Commands;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\FathomFetchCommand;

class FathomFetchCommandTest extends TestCase
{
    public function test_it_works() : void
    {
        $post = Post::factory()->published()->create();

        Http::fakeSequence()
            ->push([['pageviews' => 1234]])
            ->push([['visits' => 1234]])
            ->push([[
                'pageviews' => 1,
                'pathname' => "/blog/$post->random_id/foo",
            ], [
                'pageviews' => 1,
                'pathname' => "/blog/$post->random_id/bar",
            ], [
                'pageviews' => 1,
                'pathname' => "/blog/$post->random_id/$post->slug",
            ]]);

        $this->assertEquals(0, $post->views);

        Artisan::call(FathomFetchCommand::class);

        $this->assertEquals(1234, cache()->get('pageviews'));

        $this->assertEquals(1234, cache()->get('visits'));

        $this->assertEquals(3, $post->fresh()->views);
    }
}
