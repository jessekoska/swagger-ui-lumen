<?php

return [
    'api' => [
        // Edit to set the api's title
        'title'             => env('API_TITLE', 'Swagger UI Lumen'),
        // Auth token prefix, which will be appended to submitted auth_token/key
        'auth_token_prefix' => env('API_AUTH_TOKEN_PREFIX', ''),
        // Edit to set the api's Auth token
        'auth_token'        => env('API_AUTH_TOKEN', false),
        // Edit to set the api key variable in interface
        'key_var'           => env('API_KEY_VAR', 'api_key'),
        // Edit to set where to inject api key (header, query)
        'key_inject'        => env('API_KEY_INJECT', 'query'),
        // Edit to set the api's version number
        'version'           => env('DEFAULT_API_VERSION', '1'),
    ],
    'routes' => [
        // Route for accessing api documentation interface
        'api'               => 'api/documentation',
        // Route for accessing parsed swagger annotations.
        'docs'              => 'docs',
    ],
    'paths' => [
        // Absolute path to location where parsed swagger annotations will be stored
        'docs'              => storage_path('api-docs'),
        // Absolute path to directory containing the swagger annotations are stored.
        'annotations'       => base_path('app'),
        // Absolute path to directory where to export assets
        'assets'            => base_path('public/vendor/swagger-ui-lumen'),
        // Path to assets public directory
        'assets_public'     => '/vendor/swagger-ui-lumen',
        // Absolute path to directory where to export views
        'views'             => base_path('resources/views/vendor/swagger-ui-lumen'),
    ],
    // Turn this off to remove swagger generation on production
    'generate_always' => env('SWAGGER_GENERATE_ALWAYS', true),
];