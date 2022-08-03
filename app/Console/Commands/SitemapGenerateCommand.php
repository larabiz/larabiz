<?php

namespace App\Console\Commands;

use App\Models\Post;
use Spatie\Sitemap\Sitemap;
use Illuminate\Console\Command;

class SitemapGenerateCommand extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate sitemap';

    public function handle() : int
    {
        $sitemap = Sitemap::create();

        $sitemap->add(route('home'));

        $sitemap->add(route('posts.index'));

        Post::latest()->cursor()->each(function (Post $post) use ($sitemap) {
            $sitemap->add(route('posts.show', [$post->random_id, $post->slug]));
        });

        $sitemap->add(route('about'));

        $sitemap->add(route('community'));

        $sitemap->add(route('uses'));

        $sitemap->writeToFile(public_path('/sitemap.xml'));

        return Command::SUCCESS;
    }
}
