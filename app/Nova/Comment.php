<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class Comment extends Resource
{
    public static $group = 'Blog';

    public static $model = \App\Models\Comment::class;

    public static $title = 'content';

    public static $search = [
        'content',
    ];

    public function fields(NovaRequest $request) : array
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User')
                ->dontReorderAssociatables()
                ->showCreateRelationButton(),

            BelongsTo::make('Post')
                ->dontReorderAssociatables()
                ->showCreateRelationButton(),

            Textarea::make('Content')
                ->rules('required'),
        ];
    }

    public function cards(NovaRequest $request) : array
    {
        return [];
    }

    public function filters(NovaRequest $request) : array
    {
        return [];
    }

    public function lenses(NovaRequest $request) : array
    {
        return [];
    }

    public function actions(NovaRequest $request) : array
    {
        return [];
    }
}
