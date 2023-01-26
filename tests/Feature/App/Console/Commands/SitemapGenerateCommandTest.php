<?php

namespace Tests\Feature\App\Console\Commands;

use Tests\TestCase;
use App\Models\Post;
use App\Models\Thread;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\SitemapGenerateCommand;

class SitemapGenerateCommandTest extends TestCase
{
    public function test_it_generates_a_sitemap_with_essential_links_that_need_indexing() : void
    {
        Post::factory(10)->forUser()->published()->create();

        Artisan::call(SitemapGenerateCommand::class);

        $content = file_get_contents(public_path('/sitemap.xml'));

        $this->assertStringContainsString(route('home'), $content);

        $this->assertStringContainsString(route('posts.index'), $content);

        Post::latest()->each(function (Post $post) use ($content) {
            $this->assertStringContainsString(route('posts.show', $post), $content);
        });

        Thread::latest()->each(function (Thread $thread) use ($content) {
            $this->assertStringContainsString(route('threads.show', [$thread->random_id, $thread->slug]), $content);
        });
    }
}
