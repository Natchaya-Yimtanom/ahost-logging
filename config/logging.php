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
                'handler' => Ahost\Logging\LoggingHandler::class,
                'via' => Ahost\Logging\BaseLogger::class,
                'level' => 'debug',
            ],
        ],
];