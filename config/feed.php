<?php

return [
    'feeds' => [
        'main' => [
            'items' => [App\Models\Post::class, 'getFeedItems'],
            'url' => '/feeds/blog',
            'title' => env('APP_NAME'),
            'description' => '',
            'language' => 'fr-FR',
            'image' => '',
            'format' => 'atom',
            'view' => 'feed::atom',
            'type' => '',
            'contentType' => '',
        ],
    ],
];
