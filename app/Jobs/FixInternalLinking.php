<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

// This job should be ran regularly to fix any broken
// internal link and thus, prevent SEO regressions.
class FixInternalLinking implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle() : void
    {
        Post::all()->each(function (Post $post) {
            preg_match_all('/(https:\/\/larabiz.fr\/blog\/(\w+)\/[\w-]+)/', $post->content, $matches);

            if (empty($matches[0])) {
                return;
            }

            for ($i = 0; $i < count($matches[0]); ++$i) {
                $linkToReplace = $matches[1][$i];
                $linkToReplaceRandomId = $matches[2][$i];
                $postFoundFromlinkToReplaceRandomId = Post::whereRandomId($linkToReplaceRandomId)->first();

                $post->fill(['content' => str_replace(
                    $linkToReplace,
                    route('posts.show', [$linkToReplaceRandomId, $postFoundFromlinkToReplaceRandomId->slug]),
                    $post->content
                )])->save();
            }
        });
    }
}
