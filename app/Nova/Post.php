<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\Select;
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
        'id', 'random_id', 'title', 'slug', 'content', 'excerpt',
    ];

    public static $trafficCop = false;

    public function fields(NovaRequest $request) : array
    {
        return [
            ID::make(),

            Images::make('Image', 'illustration')
                ->conversionOnIndexView('thumbnail')
                ->showStatistics()
                ->rules('nullable'),

            Text::make('Random ID')
                ->exceptOnForms()
                ->hideFromIndex(),

            BelongsTo::make('Author', 'user', User::class)
                ->rules('required')
                ->hideFromIndex()
                ->dontReorderAssociatables()
                ->showCreateRelationButton(),

            Text::make('Title')
                ->rules('required'),

            Text::make('SEO Title')
                ->rules('nullable', 'max:60'),

            Slug::make('Slug')
                ->from('Title')
                ->placeholder('some-keywords-that-will-boost-seo')
                ->hideFromIndex(),

            Markdown::make('Content')
                ->rules('required'),

            Textarea::make('Excerpt')
                ->rules('required')
                ->placeholder('Short text that makes the user want to read.'),

            Textarea::make('SEO Excerpt')
                ->rules('nullable', 'min:120', 'max:155'),

            Badge::make('Status')->types([
                'draft' => 'bg-gray-100 text-gray-400',
                'published' => 'bg-green-100 text-green-500',
            ])->labels([
                'draft' => 'Draft',
                'published' => 'Published',
            ]),

            Select::make('Status')
                ->options([
                    'draft' => 'Draft',
                    'published' => 'Published',
                ])
                ->fillUsing(function () {
                })
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

    public static function indexQuery(NovaRequest $request, $query)
    {
        $query->withoutGlobalScopes();

        return parent::indexQuery($request, $query);
    }
}
