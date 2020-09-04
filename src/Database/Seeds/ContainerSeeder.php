<?php

declare(strict_types=1);

namespace Voice\Containers\Database\Seeds;

use Illuminate\Database\Seeder;
use Voice\Containers\App\Container;

class ContainerSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['name' => 'Default'],
            ['name' => 'Container 1'],
            ['name' => 'Container 2'],
            ['name' => 'Container 3'],
            ['name' => 'Container 4'],
            ['name' => 'Container 5'],
        ];

        Container::insert($data);
    }
}
