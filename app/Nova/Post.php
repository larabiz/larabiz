<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;

class Post extends Resource
{
    public static $group = 'Blog';

    public static $model = \App\Models\Post::class;

    public static $title = 'title';

    public static $search = [
        'id', 'title', 'slug', 'content', 'excerpt',
    ];

    public function fields(NovaRequest $request) : array
    {
        return [
            ID::make(),

            Images::make('Image', 'illustration')
                ->conversionOnIndexView('thumbnail')
                ->showStatistics()
                ->rules('required'),

            Text::make('Random ID')
                ->exceptOnForms()
                ->hideFromIndex(),

            BelongsTo::make('Author', 'user', User::class)
                ->rules('required')
                ->hideFromIndex(),

            Text::make('Title')
                ->rules('required')
                ->placeholder('Some title written with SEO in mind.'),

            Slug::make('Slug')
                ->from('Title')
                ->hideFromIndex()
                ->placeholder('some-keywords-that-will-boost-seo'),

            Markdown::make('Content')
                ->rules('required'),

            Textarea::make('Excerpt')
                ->rules('required')
                ->placeholder('Short text that makes the user want to read.'),

            Number::make('Certified for Laravel')
                ->rules('nullable', 'min:1')
                ->placeholder('e.g. 9')
                ->hideFromIndex(),

            Badge::make('Status', 'is_draft')
                ->map([
                    true => 'danger',
                    false => 'success',
                ])
                ->labels([
                    true => 'Draft',
                    false => 'Published',
                ]),

            Boolean::make('Is Draft')
                ->onlyOnForms(),

            Text::make('Comments', 'comments_count')
                ->sortable()
                ->exceptOnForms(),

            HasMany::make('Comments'),

            Images::make('Images', 'images')
                ->conversionOnForm('large')
                ->showStatistics()
                ->hideFromIndex(),
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
