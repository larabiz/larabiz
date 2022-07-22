<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class Discussion extends Resource
{
    public static $group = 'Discussions';

    public static $model = \App\Models\Discussion::class;

    public static $title = 'title';

    public static $search = [
        'title',
        'content',
    ];

    public function fields(NovaRequest $request) : array
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User'),

            Text::make('Title'),

            Textarea::make('Content'),

            Text::make('Replies Count')
                ->exceptOnForms(),

            HasMany::make('Replies'),
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
