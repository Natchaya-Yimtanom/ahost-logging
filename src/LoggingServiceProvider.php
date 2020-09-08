<?php

namespace Ahost\Logging;

use Illuminate\Support\ServiceProvider;

use Ahost\Logging\ActivateAllCommand;
use Ahost\Logging\TruncateTable;

class LoggingServiceProvider extends ServiceProvider
{
    
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.logging:activate', function () {
            return new ActivateAllCommand();
        });

        $this->app->singleton('command.logging:truncate', function () {
            return new TruncateTable();
        });

        $this->commands(
            'command.logging:activate',
            'command.logging:truncate',
        );

    }
}
