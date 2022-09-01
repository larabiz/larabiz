<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'fathom' => [
        'api_token' => env('FATHOM_API_TOKEN'),
        'site_id' => env('FATHOM_SITE_ID'),
    ],

    'envoyer' => [
        'fathom_fetch_heartbeat_url' => env('ENVOYER_FATHOM_FETCH_HEARTBEAT_URL'),
        'sitemap_generate_heartbeat_url' => env('ENVOYER_SITEMAP_GENERATE_HEARTBEAT_URL'),
    ],
];
