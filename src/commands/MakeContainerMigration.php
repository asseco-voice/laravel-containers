<?php

namespace Voice\Containers\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class MakeContainerMigration extends GeneratorCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'asseco-voice:make-container';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '...';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Model';

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        $stub = '/stubs/container-migration.create.stub';

        return $this->resolveStubPath($stub);
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param string $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $models = $this->getModelsWithContainableTrait();

        foreach ($models as $model) {
            $this->createMigration($model . "Container");
        }
    }

    /**
     * Create a migration file for the model.
     *
     * @param $name
     * @return void
     */
    protected function createMigration($name)
    {
        $table = Str::snake(Str::pluralStudly(class_basename($name)));

        if ($this->option('pivot')) {
            $table = Str::singular($table);
        }

        $this->call('make:migration', [
            'name' => "create_{$table}_table",
            '--create' => $table,
        ]);
    }

    protected function getModelsWithContainableTrait()
    {
        $path = app_path(); // TODO: config
        $namespace = 'App\\'; // TODO: config
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
        $containable = "Voice\Containers\Traits\Containable";  // TODO: config

        return in_array($containable, $traits);
    }
}
