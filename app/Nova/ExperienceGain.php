<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class ExperienceGain extends Resource
{
    public static $group = 'Community';

    public static $model = \App\Models\ExperienceGain::class;

    public static $title = 'title';

    public static $search = [
        'id',
        'user.username',
        'points',
        'message',
    ];

    public function subtitle() : string
    {
        return "« $this->message »";
    }

    public function fields(NovaRequest $request) : array
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User'),

            Number::make('Points')
                ->rules('required'),

            Text::make('Message')
                ->rules('required', 'max:255'),
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
