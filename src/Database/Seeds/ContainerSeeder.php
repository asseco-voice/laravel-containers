<?php

declare(strict_types=1);

namespace Asseco\Containers\Database\Seeds;

use Asseco\Containers\App\Models\Container;
use Faker\Factory;
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

        if (config('app.env') === 'local') {
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
