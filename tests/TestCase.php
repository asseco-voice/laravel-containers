<?php

declare(strict_types=1);

namespace Asseco\Containers\Tests;

use Asseco\Containers\ContainerServiceProvider;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->runLaravelMigrations();
    }

    protected function getPackageProviders($app)
    {
        return [ContainerServiceProvider::class];
    }
}
