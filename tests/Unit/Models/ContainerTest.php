<?php

declare(strict_types=1);

namespace Asseco\Containers\Tests\Unit\Models;

use Asseco\Containers\App\Models\Container;
use Asseco\Containers\Database\Factories\ContainerFactory;
use Asseco\Containers\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ContainerTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function has_factory()
    {
        $this->assertInstanceOf(ContainerFactory::class, Container::factory());
    }
}
