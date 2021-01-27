<?php

declare(strict_types=1);

namespace Asseco\Containers\Tests\Feature\Console\Commands;

use Asseco\Containers\Tests\TestCase;

class MakeContainersTest extends TestCase
{
    /** @test */
    public function command_creates_migration()
    {
        config([
            'asseco-containers.models_path'     => __DIR__ . '/../../..',
            'asseco-containers.model_namespace' => 'Asseco\\Containers\\Tests\\',
        ]);

        $this->artisan('asseco:containers')
            ->assertExitCode(0);

        $files = scandir(database_path('migrations'));

        $migrationExists = array_filter($files, function ($file) {
            return strpos($file, 'add_container_id_to_containable_models_table');
        });

        $this->assertTrue((bool) $migrationExists);
    }
}
