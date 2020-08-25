<?php

return [
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
];