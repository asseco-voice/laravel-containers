<?php

declare(strict_types=1);

namespace Asseco\Containers\App\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Containable
{
    public function container(): BelongsTo
    {
        return $this->belongsTo(config('asseco-containers.models.container'));
    }
}
