<?php

declare(strict_types=1);

namespace Asseco\Containers\Database\Seeders;

use Asseco\Containers\App\Contracts\Container;
use Illuminate\Database\Seeder;

class ContainerSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * @var $container Container
         */
        $container = app(Container::class);

        $container::factory()->count(50)->create();
    }
}
