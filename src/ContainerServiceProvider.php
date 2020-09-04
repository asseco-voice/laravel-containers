<?php

declare(strict_types=1);

namespace Voice\Containers;

use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\ServiceProvider;
use Voice\Containers\App\Console\Commands\MakeContainers;

class ContainerServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/asseco-containers.php', 'asseco-containers');
        $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/../config/asseco-containers.php' => config_path('asseco-containers.php'),]);

        $this->registerCreator();
        $this->registerMigrateMakeCommand();

        $this->commands([
            'asseco-voice.command.migrate.make',
        ]);
    }

    /**
     * Register the migration creator.
     *
     * @return void
     */
    protected function registerCreator()
    {
        $this->app->singleton('asseco-voice.migration.creator', function ($app) {
            return new MigrationCreator($app['files'], __DIR__ . '/../stubs');
        });
    }

    /**
     * Register the command.
     *
     * @return void
     */
    protected function registerMigrateMakeCommand()
    {
        $this->app->singleton('asseco-voice.command.migrate.make', function ($app) {
            $creator = $app['asseco-voice.migration.creator'];
            $composer = $app['composer'];

            return new MakeContainers($creator, $composer);
        });
    }
}
