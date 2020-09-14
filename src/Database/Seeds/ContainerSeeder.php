<?php

declare(strict_types=1);

namespace Voice\Containers\Database\Seeds;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Voice\Containers\App\Container;

class ContainerSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        Container::query()->updateOrCreate(
            ['name' => 'Default'],
            [
                'created_at' => $now,
                'updated_at' => $now,
            ]);

        $data = [
            [
                'name'       => 'Container 1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name'       => 'Container 2',
                'created_at' => $now,
                'updated_at' => $now,

            ],
            [
                'name'       => 'Container 3',
                'created_at' => $now,
                'updated_at' => $now,

            ],
            [
                'name'       => 'Container 4',
                'created_at' => $now,
                'updated_at' => $now,

            ],
            [
                'name'       => 'Container 5',
                'created_at' => $now,
                'updated_at' => $now,

            ],
        ];

        Container::query()->insert($data);
    }
}
