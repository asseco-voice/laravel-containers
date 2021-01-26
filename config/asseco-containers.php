<?php

use Asseco\Containers\App\Models\Container;
use Asseco\Containers\App\Traits\Containable;

return [
    /**
     * Container model which will be bound to the app.
     */
    'model'           => Container::class,

    /**
     * Namespace for Laravel models.
     */
    'model_namespace' => 'App\\Models\\',

    /**
     * Namespace to Containable trait.
     */
    'trait_path'      => Containable::class,

    /**
     * Should the package run the migrations. Set to false if you're publishing
     * and changing default migrations.
     */
    'runs_migrations' => true,
];
