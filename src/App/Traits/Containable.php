<?php

declare(strict_types=1);

namespace Asseco\Containers\App\Traits;

use Asseco\Containers\App\Contracts\Container;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

trait Containable
{
    public function containers(): MorphToMany
    {
        return $this->morphToMany(get_class(app(Container::class)), 'containable')->withTimestamps();
    }
}
