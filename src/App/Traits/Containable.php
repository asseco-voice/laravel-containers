<?php

namespace Voice\Containers\App\Traits;

use Voice\Containers\App\Container;

trait Containable
{
    public function container()
    {
        return $this->belongsTo(Container::class);
    }
}
