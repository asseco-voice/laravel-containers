<?php

namespace Voice\Containers;

use Illuminate\Support\ServiceProvider;
use Voice\Containers\Commands\MakeContainerMigration;

class ContainersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {

            $this->commands([
                MakeContainerMigration::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {

    }
}
