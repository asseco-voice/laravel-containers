<?php

declare(strict_types=1);

namespace Asseco\Containers\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContainerFactory extends Factory
{
    public function modelName()
    {
        return config('asseco-containers.model') ?: parent::modelName();
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'       => $this->faker->unique()->word,
            'owner_id'   => $this->faker->randomNumber(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
