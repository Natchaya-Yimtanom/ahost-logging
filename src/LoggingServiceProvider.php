<?php

namespace Quinn\Logging;

use Illuminate\Support\ServiceProvider;

use Quinn\Logging\AddRegisterInProvider;
use Quinn\Logging\AddBootInProvider;
use Quinn\Logging\TruncateTable;
use Quinn\Logging\PublishConfig;
use Quinn\Logging\PublishMigrations;
use Quinn\Logging\AddRoute;
use Quinn\Logging\MoveControllerFile;


class LoginServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('command.quinn-logging:kernel-command', function () {
            return new AddCommandInKernel();
        });

        $this->app->singleton('command.quinn-logging:activate-all', function () {
            return new ActivateAllCommand();
        });

        $this->app->singleton('command.quinn-logging:add-route', function () {
            return new AddRoute();
        });

        $this->app->singleton('command.quinn-logging:publish-migrations', function () {
            return new PublishMigrations();
        });

        $this->app->singleton('command.quinn-logging:publish-config', function () {
            return new PublishConfig();
        });

        $this->app->singleton('command.quinn-logging:truncate-table', function () {
            return new TruncateTable();
        });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands(
            'command.quinn-logging:kernel-command',
            'command.quinn-logging:activate-all',
            'command.quinn-logging:add-route',
            'command.quinn-logging:publish-migrations',
            'command.quinn-logging:publish-config',
            'command.quinn-logging:truncate-table',
        );
    }
}
