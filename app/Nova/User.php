<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Illuminate\Validation\Rules;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class User extends Resource
{
    public static $group = 'Community';

    public static $model = \App\Models\User::class;

    public static $title = 'username';

    public static $search = [
        'id', 'username', 'email',
    ];

    public function fields(NovaRequest $request) : array
    {
        return [
            ID::make()->sortable(),

            Gravatar::make()->maxWidth(50),

            Text::make('Username')
                ->rules('required', 'max:255'),

            Text::make('URL GitHub', 'github')
                ->rules('nullable', 'url', 'regex:/^https?:\/\/github.com\//')
                ->hideFromIndex(),

            Text::make('URL LinkedIn', 'linkedin')
                ->rules('nullable', 'url', 'regex:/^https?:\/\/(www\.)?linkedin.com\/in\//')
                ->hideFromIndex(),

            Textarea::make('Biography')
                ->rules('nullable', 'max:255'),

            Text::make('Email')
                ->rules('required', 'email', 'max:254')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            DateTime::make('Email Verified At')
                ->rules('nullable'),

            Password::make('Password')
                ->onlyOnForms()
                ->creationRules('required', Rules\Password::defaults())
                ->updateRules('nullable', Rules\Password::defaults()),
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
