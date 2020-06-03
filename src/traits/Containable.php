<?php

namespace Voice\Containers\Traits;

use Voice\Containers\Container;

trait Containable
{
    public function containers()
    {
        return $this->belongsToMany(Container::class);
    }
}
