<?php

declare(strict_types=1);

namespace Voice\Containers\App\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait Containable
{
    public function container(): BelongsTo
    {
        return $this->belongsTo(config('asseco-containers.model'));
    }
}
