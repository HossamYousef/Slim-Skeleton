<?php
return [
    'settings' => [
        /*
        |--------------------------------------------------------------------------
        | General Application settings
        |--------------------------------------------------------------------------
         */
        'httpVersion'                       => '1.1',
        'responseChunkSize'                 => 4096,
        'outputBuffering'                   => 'append',
        'determineRouteBeforeAppMiddleware' => true,
        'displayErrorDetails'               => env('APP_DEBUG', false),
        'addContentLengthHeader'            => true,
        'routerCacheFile'                   => false,
        'timezone'                          => env('TIMEZONE', 'Africa/Cairo'),
        'url'                               => env('APP_URL', 'http://127.0.0.1/Slim'),

        /*
        |--------------------------------------------------------------------------
        | Twig View settings
        |--------------------------------------------------------------------------
         */
        'view'                              => [
            'template_path'     => __DIR__ . '/../resources/view',
            'template_settings' => [
                'cache'       => __DIR__ . '/../storage/cache/twig',
                'debug'       => env('APP_DEBUG', false),
                'auto_reload' => true,
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Mail settings
        |--------------------------------------------------------------------------
         */
        'Mail'                              => [
            'host'       => env('MAIL_HOST', 'smtp.gmail.com'),
            'port'       => env('MAIL_PORT', '587'),
            'username'   => env('MAIL_USERNAME', ''),
            'password'   => env('MAIL_PASSWORD', ''),
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
        ],

        /*
        |--------------------------------------------------------------------------
        | Mail Renderer settings
        |--------------------------------------------------------------------------
         */
        'MailRenderer'                      => [
            'template_path'     => __DIR__ . '/../resources/mail',
            'template_settings' => [
                'cache'       => __DIR__ . '/../storage/cache/mail',
                'debug'       => env('APP_DEBUG', false),
                'auto_reload' => true,
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Monolog Logger settings
        |--------------------------------------------------------------------------
         */
        'logger'                            => [
            'name'  => 'app',
            'path'  => __DIR__ . '/../storage/logger/app.log',
            'level' => Monolog\Logger::DEBUG,
        ],

        /*
        |--------------------------------------------------------------------------
        | Elloquent Database Settings
        |--------------------------------------------------------------------------
         */
        'database'                          => [
            'connections' => [
                'driver'    => env('DATABASE_DRIVER', 'mysql'),
                'host'      => env('DATABASE_HOST', '127.0.0.1'),
                'database'  => env('DATABASE_DBNAME', ''),
                'username'  => env('DATABASE_USERNAME', ''),
                'password'  => env('DATABASE_PASSWORD', ''),
                'charset'   => env('DATABASE_CHARSET', 'utf8'),
                'collation' => env('DATABASE_COLLATION', 'utf8_unicode_ci'),
                'prefix'    => env('DATABASE_PREFIX', ''),
            ],
        ],

    ],
];
