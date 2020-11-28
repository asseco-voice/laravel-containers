<?php

declare(strict_types=1);

namespace Asseco\Containers\App;

use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    protected $fillable = ['name', 'owner_id'];
}
