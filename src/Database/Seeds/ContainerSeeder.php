<?php

declare(strict_types=1);

namespace Voice\Containers\Database\Seeds;

use Faker\Factory;
use Illuminate\Database\Seeder;
use Voice\Containers\App\Container;

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
            $faker = Factory::create();

            $amount = 50;

            $data = [];
            for ($i = 0; $i < $amount; $i++) {
                $data[] = [
                    'name'     => implode(' ', $faker->words) . ' container',
                    'owner_id' => $faker->uuid,
                ];
            }

            $container::query()->upsert($data, 'name');
        }
    }
}
