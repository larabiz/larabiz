<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Comment;
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

        Comment::latest()->cursor()->each(function (Comment $comment) use ($sitemap) {
            $sitemap->add(route('posts.comments.show', $comment));
        });

        $sitemap->writeToFile(public_path('/sitemap.xml'));

        return Command::SUCCESS;
    }
}
