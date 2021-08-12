<?php

declare(strict_types=1);

namespace Asseco\Containers;

use Asseco\Containers\App\Console\Commands\MakeContainers;
use Asseco\Containers\App\Contracts\Container;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\ServiceProvider;

class ContainerServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/asseco-containers.php', 'asseco-containers');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        if (config('asseco-containers.migrations.run')) {
            $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        }
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../migrations' => database_path('migrations'),
        ], 'asseco-containers');

        $this->publishes([
            __DIR__ . '/../config/asseco-containers.php' => config_path('asseco-containers.php'),
        ], 'asseco-containers');

        $this->app->bind(Container::class, config('asseco-containers.models.container'));
    }
}
