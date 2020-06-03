<?php

namespace Voice\Containers\Commands;

use Illuminate\Database\Console\Migrations\MigrateMakeCommand;
use Illuminate\Database\Console\Migrations\TableGuesser;
use Illuminate\Support\Str;
use InvalidArgumentException;

class MakeContainers extends MigrateMakeCommand
{
    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'asseco-voice:containers
        {--path= : The location where the migration files should be created}
        {--realpath : Indicate any provided migration file paths are pre-resolved absolute paths}
        {--fullpath : Output the full path of the migrations}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creating container migrations for models having Containable trait';

    public function handle()
    {
        $models = $this->getModelsWithContainableTrait();

        foreach ($models as $model) {
            $this->createMigration($model);
        }

        $this->composer->dumpAutoloads();
    }

    protected function getModelsWithContainableTrait()
    {
        $path = config('asseco-voice.containers.models_path');
        $namespace = config('asseco-voice.containers.model_namespace');
        $models = [];
        $results = scandir($path);

        foreach ($results as $result) {
            if ($result === '.' or $result === '..') continue;

            $filename = $path . '/' . $result;

            if (is_dir($filename)) continue;

            $result = substr($result, 0, -4);

            if ($this->hasContainableTrait($namespace . $result)) {
                $models[] = $result;
            }
        }
        return $models;
    }

    protected function hasContainableTrait($class)
    {
        $traits = class_uses($class);
        $containable = config('asseco-voice.containers.trait_path');

        return in_array($containable, $traits);
    }

    protected function createMigration($model)
    {
        $modelSnakeCase = Str::snake(class_basename($model));

        $models = ['container', $modelSnakeCase];
        sort($models);

        $name = "create_{$models[0]}_{$models[1]}_table";

        [$table, $create] = TableGuesser::guess($name);

        try {
            $this->writeMigrationOverloaded($name, $table, $create, $model);
        } catch (InvalidArgumentException $e) {
            $this->line("Migration {$name} already exists. Skipping...");
            return;
        }
    }

    protected function writeMigrationOverloaded($name, $table, $create, $model)
    {
        $file = $this->creator->createOverloaded(
            $name, $this->getMigrationPath(), $model, $table, $create
        );

        if (!$this->option('fullpath')) {
            $file = pathinfo($file, PATHINFO_FILENAME);
        }

        $this->line("<info>Created Migration:</info> {$file}");
    }
}
