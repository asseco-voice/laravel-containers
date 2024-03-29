<?php

declare(strict_types=1);

namespace Asseco\Containers\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ContainerFactory extends Factory
{
    public function modelName()
    {
        return config('asseco-containers.models.container');
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $data = [
            'name'       => $this->faker->unique()->word,
            'owner_id'   => $this->faker->randomNumber(),
            'created_at' => now(),
            'updated_at' => now(),
        ];

        if (config('asseco-containers.migrations.uuid')) {
            $data = array_merge($data, [
                'owner_id'   => Str::uuid(),
            ]);
        }

        return $data;
    }
}
