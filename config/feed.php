<?php

return [
    'feeds' => [
        'main' => [
            'items' => [App\Models\Post::class, 'getFeedItems'],
            'url' => '/feeds/blog',
            'title' => 'Flux des articles',
            'description' => 'Tout ce qui est publié sur le blog.',
            'language' => 'fr-FR',
            'image' => '',
            'format' => 'atom',
            'view' => 'feed::atom',
            'type' => '',
            'contentType' => '',
        ],
    ],
];
