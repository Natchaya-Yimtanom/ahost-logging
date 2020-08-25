<?php
use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;
return [
/*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    */
        'default' => env('LOG_CHANNEL', 'stack'),
/*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    */
        'channels' => [

            'logging' => [
                'driver' => 'custom',
                'handler' => Quinn\Logging\LoggingHandler::class,
                'via' => Quinn\Logging\BaseLogger::class,
                'level' => 'debug',
            ],

        'emergency' => [
                    'path' => storage_path('logs/laravel.log'),
                ],
        ],

         /*
    |--------------------------------------------------------------------------
    | Pattern and storage path settings
    |--------------------------------------------------------------------------
    |
    | The env key for pattern and storage path with a default value
    |
    */

        'key'  => env('APP_KEY', 't5CYAMMzikr0faHq2gI1x2JekQhPC5gn'),
];