<?php

namespace Voice\Containers;

use Illuminate\Console\Events\CommandFinished;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Console\Output\ConsoleOutput;
use Voice\Containers\App\Console\Commands\MakeContainers;

class ContainerServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/asseco-containers.php', 'asseco-containers');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishes([__DIR__ . '/config/asseco-containers.php' => config_path('asseco-containers.php'),]);

        $this->registerCreator();
        $this->registerMigrateMakeCommand();
        $this->registerSeedsFrom(__DIR__ . '/database/seeds');

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
            return new MigrationCreator($app['files'], __DIR__ . '/stubs');
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

    protected function registerSeedsFrom($path)
    {
        if ($this->app->runningInConsole()) {
            if ($this->seedCommandRunning()) {
                $this->addSeedsAfterConsoleCommandFinished($path);
            }
        }
    }

    protected function seedCommandRunning(): bool
    {
        $args = request()->server('argv', null);
        if (is_array($args)) {
            $command = implode(' ', $args);
            if ($command === 'artisan db:seed') {
                return true;
            }
        }
        return false;
    }

    protected function addSeedsAfterConsoleCommandFinished(string $path)
    {
        Event::listen(CommandFinished::class, function (CommandFinished $event) use ($path) {
            if ($event->output instanceof ConsoleOutput) {
                $this->addSeedsFrom($path);
            }
        });
    }

    protected function addSeedsFrom($seeds_path)
    {
        $file_names = glob("$seeds_path/*.php");
        foreach ($file_names as $filename) {
            include $filename;
            $classes = get_declared_classes();
            $class = end($classes);

            Artisan::call('db:seed', ['--class' => $class]);
        }
    }
}
