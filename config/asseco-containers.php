<?php

use Voice\Containers\App\Container;
use Voice\Containers\App\Traits\Containable;

return [
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
     * Container model which will be bound to the app.
     */
    'model'           => Container::class,
];
