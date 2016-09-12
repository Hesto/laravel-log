<?php

namespace Hesto\LaravelLogs;

use Illuminate\Support\ServiceProvider;

class LogsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //$this->registerInstallCommand();
    }

    /**
     * Register the logs:install command.
     */
    private function registerInstallCommand()
    {
        $this->app->singleton('command.hesto.logs.install', function ($app) {
            return $app['Hesto\LaravelLogs\Commands\LogsInstallCommand'];
        });

        $this->commands('command.hesto.logs.install');
    }
}
