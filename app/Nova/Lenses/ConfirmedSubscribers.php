<?php

namespace App\Nova\Lenses;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Lenses\Lens;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\LensRequest;
use Laravel\Nova\Http\Requests\NovaRequest;

class ConfirmedSubscribers extends Lens
{
    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     *
     * @return mixed
     */
    public static function query(LensRequest $request, $query)
    {
        return $request->withOrdering($request->withFilters(
            $query->whereNotNull('confirmed_at')
        ));
    }

    public function fields(NovaRequest $request) : array
    {
        return [
            ID::make()->sortable(),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            DateTime::make('Confirmed At')
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

    public function uriKey() : string
    {
        return 'confirmed-subscribers';
    }
}
