<?php

namespace App\Jobs;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Spatie\Browsershot\Browsershot;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GeneratePostPreview implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public readonly Post $post
    ) {
    }

    public function handle() : void
    {
        $directory = Storage::disk('public')->makeDirectory('previews');

        throw_if(! $directory, 'Directory could not be created.');

        Browsershot::url(route('preview', $this->post))
            ->windowSize(736, 414)
            ->deviceScaleFactor(2)
            ->save(storage_path("app/public/previews/{$this->post->random_id}.png"));
    }
}
