<?php

namespace App\Actions;

use App\Models\Post;
use Illuminate\Support\Facades\URL;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Storage;

class CreatePostPreview
{
    public function create(Post $post) : string
    {
        $directory = Storage::disk('public')->makeDirectory('previews');

        throw_if(! $directory, 'Directory could not be created.');

        $filename = sha1($post->random_id . microtime(true)) . '.png';

        app(Browsershot::class)
            ->setUrl(URL::signedRoute('preview', $post))
            ->windowSize(600, 315)
            ->deviceScaleFactor(2)
            ->save(storage_path("app/public/previews/$filename"));

        if ($post->preview) {
            Storage::disk('public')->delete($post->preview);
        }

        $post->update(['preview' => "previews/$filename"]);

        return $post->preview;
    }
}
