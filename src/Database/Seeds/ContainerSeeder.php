<?php

declare(strict_types=1);

namespace Voice\Containers\Database\Seeds;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
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

        if (Config::get('app.env') !== 'production') {

            $faker = Factory::create();

            $amount = 50;

            $data = [];
            for ($i = 0; $i < $amount; $i++) {
                $data[] = [
                    'name'       => implode(' ', $faker->words) . ' container',
                    'created_at' => $now,
                    'updated_at' => $now,
                    'owner_id'   => $faker->uuid,
                ];
            }

            Container::query()->insert($data);

        }
    }
}
