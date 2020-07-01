<?php

namespace Voice\Containers\App\Traits;

use Voice\Containers\App\Container;

trait Containable
{
    public function containers()
    {
        return $this->belongsToMany(Container::class);
    }
}
