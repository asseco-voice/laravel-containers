<?php

declare(strict_types=1);

namespace Voice\Containers\App\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Config;
use Voice\Containers\App\Container;

trait Containable
{
    public function container(): BelongsTo
    {
        /**
         * @var $container Container
         */
        $container = Config::get('asseco-containers.model');

        return $this->belongsTo($container);
    }
}
