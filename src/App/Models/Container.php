<?php

declare(strict_types=1);

namespace Asseco\Containers\App\Models;

use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
    protected $fillable = ['name', 'owner_id'];
}
