<?php

declare(strict_types=1);

namespace Asseco\Containers\Tests;

use Asseco\Containers\ContainerServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        // TODO: I really hope there is a better way to handle this...
        foreach (scandir(database_path('migrations')) as $migration) {
            if (!str_starts_with($migration, '.')) {
                exec("rm " . database_path("migrations/$migration"));
            }
        }

        $this->runLaravelMigrations();
    }

    protected function getPackageProviders($app)
    {
        return [ContainerServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
