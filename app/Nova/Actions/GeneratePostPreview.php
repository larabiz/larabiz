<?php

namespace App\Nova\Actions;

use App\Models\Post;
use Illuminate\Bus\Queueable;
use Laravel\Nova\Actions\Action;
use App\Actions\CreatePostPreview;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Nova\Http\Requests\NovaRequest;

class GeneratePostPreview extends Action implements ShouldQueue
{
    use InteractsWithQueue, Queueable;

    public function handle(ActionFields $fields, Collection $models)
    {
        $models->each(function (Post $post) {
            (new CreatePostPreview)->create($post);
        });
    }

    public function fields(NovaRequest $request) : array
    {
        return [];
    }
}
