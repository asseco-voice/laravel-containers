<?php

namespace Asseco\Containers\Tests;

use Asseco\Containers\App\Traits\Containable;
use Illuminate\Database\Eloquent\Model;

class ContainableModel extends Model
{
    use Containable;
}
