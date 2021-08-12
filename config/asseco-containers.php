<?php

use Asseco\BlueprintAudit\App\MigrationMethodPicker;
use Asseco\Containers\App\Models\Container;

return [

    /**
     * Model bindings.
     */
    'models' => [
        'container' => Container::class,
    ],

    'migrations' => [

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

];
