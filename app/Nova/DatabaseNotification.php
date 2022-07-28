<?php

namespace App\Nova;

use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\MorphTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;

class DatabaseNotification extends Resource
{
    public static $model = \Illuminate\Notifications\DatabaseNotification::class;

    public static $title = 'data->message';

    public static $search = [
        'id', 'type',
    ];

    public function fields(NovaRequest $request) : array
    {
        return [
            Text::make('ID')
                ->exceptOnForms(),

            MorphTo::make('Notifiable'),

            Text::make('Type')
                ->rules('required'),

            Code::make('Data')->json(),

            DateTime::make('Read At')
                ->rules('nullable'),
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
