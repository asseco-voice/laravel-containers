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
     * Path to original stub which will create the migration upon publishing.
     */
    'stub_path' => '/../migrations/create_containers_table.php.stub',
];
