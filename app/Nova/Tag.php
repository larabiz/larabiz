<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use App\Nova\Lenses\ConfirmedSubscribers;
use Laravel\Nova\Http\Requests\NovaRequest;

class Tag extends Resource
{
    public static $model = \Spatie\Tags\Tag::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name', 'slug',
    ];

    public function fields(NovaRequest $request) : array
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->rules('required'),

            Slug::make('Slug')
                ->from('Name')
                ->rules('required'),

            Text::make('Type')
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
        return [
            new ConfirmedSubscribers,
        ];
    }

    public function actions(NovaRequest $request) : array
    {
        return [];
    }
}
