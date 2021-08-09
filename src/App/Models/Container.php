<?php

declare(strict_types=1);

namespace Asseco\Containers\App\Models;

use Asseco\Containers\Database\Factories\ContainerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Container extends Model implements \Asseco\Containers\App\Contracts\Container
{
    use HasFactory;

    protected $fillable = ['name', 'owner_id'];

    protected static function newFactory()
    {
        return ContainerFactory::new();
    }
}
