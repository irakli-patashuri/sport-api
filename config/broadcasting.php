<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Broadcaster
    |--------------------------------------------------------------------------
    |
    | Supported: "pusher", "ably", "redis", "log", "null"
    |
    | Laravel Reverb (Laravel 11+) speaks the Pusher protocol.
    | On Laravel 9 we use the same protocol via the "pusher" / "reverb" connection
    | pointing at a local WebSocket server (Reverb or Soketi).
    |
    */

    'default' => env('BROADCAST_DRIVER', 'pusher'),

    'connections' => [

        /*
        | Reverb-compatible connection (Pusher protocol).
        | Works with: Laravel Reverb, Soketi, laravel-websockets.
        */
        'reverb' => [
            'driver' => 'pusher',
            'key' => env('REVERB_APP_KEY', env('PUSHER_APP_KEY')),
            'secret' => env('REVERB_APP_SECRET', env('PUSHER_APP_SECRET')),
            'app_id' => env('REVERB_APP_ID', env('PUSHER_APP_ID')),
            'options' => [
                'host' => env('REVERB_HOST', env('PUSHER_HOST', '127.0.0.1')),
                'port' => env('REVERB_PORT', env('PUSHER_PORT', 8080)),
                'scheme' => env('REVERB_SCHEME', env('PUSHER_SCHEME', 'http')),
                'encrypted' => env('REVERB_SCHEME', env('PUSHER_SCHEME', 'http')) === 'https',
                'useTLS' => env('REVERB_SCHEME', env('PUSHER_SCHEME', 'http')) === 'https',
            ],
            'client_options' => [],
        ],

        'pusher' => [
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'app_id' => env('PUSHER_APP_ID'),
            'options' => [
                'host' => env('PUSHER_HOST') ?: 'api-'.env('PUSHER_APP_CLUSTER', 'mt1').'.pusher.com',
                'port' => env('PUSHER_PORT', 443),
                'scheme' => env('PUSHER_SCHEME', 'https'),
                'encrypted' => true,
                'useTLS' => env('PUSHER_SCHEME', 'https') === 'https',
            ],
            'client_options' => [],
        ],

        'ably' => [
            'driver' => 'ably',
            'key' => env('ABLY_KEY'),
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
        ],

        'log' => [
            'driver' => 'log',
        ],

        'null' => [
            'driver' => 'null',
        ],

    ],

];
