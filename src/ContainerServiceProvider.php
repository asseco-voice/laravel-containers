<?php

namespace Asseco\Containers;

use Asseco\Containers\App\Console\Commands\MakeContainers;
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

        if (config('asseco-containers.runs_migrations')) {
            $this->loadMigrationsFrom(__DIR__ . '/../migrations');
        }
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $timestamp = now()->format('Y_m_d_His');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path("migrations/{$timestamp}_create_containers_table.php"),
        ], 'asseco-containers-migrations');

        $this->publishes([
            __DIR__ . '/../config/asseco-containers.php' => config_path('asseco-containers.php'),
        ], 'asseco-containers-config');

        $this->registerCreator();
        $this->registerMigrateMakeCommand();

        $this->commands([
            'voice.command.migrate.make',
        ]);
    }

    /**
     * Register the migration creator.
     *
     * @return void
     */
    protected function registerCreator()
    {
        app()->singleton('voice.migration.creator', function ($app) {
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
        app()->singleton('voice.command.migrate.make', function ($app) {
            $creator = $app['voice.migration.creator'];
            $composer = $app['composer'];

            return new MakeContainers($creator, $composer);
        });
    }
}
