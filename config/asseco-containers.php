<?php

use Asseco\BlueprintAudit\App\MigrationMethodPicker;
use Asseco\Containers\App\Models\Container;
use Asseco\Containers\App\Traits\Containable;

return [

    /**
     * Model bindings
     */
    'models' => [
        'container' => Container::class,
    ],

    'migrations'      => [

        /**
         * UUIDs as primary keys.
         */
        'uuid'       => false,

        /**
         * Timestamp types.
         *
         * @see https://github.com/asseco-voice/laravel-common/blob/master/config/asseco-common.php
         */
        'timestamps' => MigrationMethodPicker::PLAIN,

        /**
         * Should the package run the migrations. Set to false if you're publishing
         * and changing default migrations.
         */
        'run'        => true,
    ],

    /**
     * Path to Laravel models. This does not recurse in folders.
     */
    'models_path'     => app_path('Models'),

    /**
     * Namespace for Laravel models.
     */
    'model_namespace' => 'App\\Models\\',

    /**
     * Namespace to Containable trait.
     */
    'trait_path'      => Containable::class,
];
