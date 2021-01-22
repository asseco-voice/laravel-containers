<?php

use Asseco\Containers\App\Models\Container;
use Asseco\Containers\App\Traits\Containable;

return [
    /**
     * Container model which will be bound to the app.
     */
    'model'           => Container::class,

    /**
     * Path to Laravel models. This does not recurse in folders.
     */
    'models_path'     => app_path(),

    /**
     * Namespace for Laravel models.
     */
    'model_namespace' => 'App\\',

    /**
     * Namespace to Containable trait.
     */
    'trait_path'      => Containable::class,

    /**
     * Path to original stub which will create the migration upon publishing.
     */
    'stub_path' => '/../migrations/create_containers_table.php.stub',
];
