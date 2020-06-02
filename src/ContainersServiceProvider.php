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

    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->registerCreator();
        $this->registerMigrateMakeCommand();

        if ($this->app->runningInConsole()) {
            $this->commands([
                'asseco-voice.command.migrate.make',
            ]);
        }
    }

    /**
     * Register the migration creator.
     *
     * @return void
     */
    protected function registerCreator()
    {
        $this->app->singleton('asseco-voice.migration.creator', function ($app) {
            return new CustomMigrationCreator($app['files'], __DIR__ . '/stubs');
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

            return new MakeContainerMigration($creator, $composer);
        });
    }
}
