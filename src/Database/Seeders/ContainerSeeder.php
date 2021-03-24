<?php

declare(strict_types=1);

namespace Asseco\Containers\Database\Seeders;

use Asseco\Containers\App\Models\Container;
use Illuminate\Database\Seeder;

class ContainerSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * @var $container Container
         */
        $container = config('asseco-containers.model');

        $container::query()->upsert(['name' => 'Default'], 'name');

        if (config('app.env') !== 'production') {
            $container::factory()->count(50)->create();
        }
    }
}
