<?php

declare(strict_types=1);

namespace Asseco\Containers\Tests\Feature\Http\Controllers;

use Asseco\Containers\App\Contracts\Container;
use Asseco\Containers\Tests\TestCase;

class ContainerControllerTest extends TestCase
{
    protected Container $container;

    public function setUp(): void
    {
        parent::setUp();

        $this->container = app(Container::class);
    }

    /** @test */
    public function can_fetch_all_containers()
    {
        $this
            ->getJson(route('containers.index'))
            ->assertJsonCount(1);

        $this->container::factory()->count(5)->create();

        $this
            ->getJson(route('containers.index'))
            ->assertJsonCount(6);

        $this->assertCount(6, $this->container::all());
    }

    /** @test */
    public function creates_container()
    {
        $this->withoutExceptionHandling();

        $request = $this->container::factory()->make()->toArray();

        $this
            ->postJson(route('containers.store'), $request)
            ->assertJsonFragment([
                'name' => $request['name'],
            ]);

        $this->assertCount(2, $this->container::all());
    }

    /** @test */
    public function can_return_container_by_id()
    {
        $containers = $this->container::factory()->count(5)->create();

        $containerId = $containers->random()->id;

        $this
            ->getJson(route('containers.show', $containerId))
            ->assertJsonFragment(['id' => $containerId]);
    }

    /** @test */
    public function can_update_container()
    {
        $Container = $this->container::factory()->create();

        $request = [
            'name' => 'updated_name',
        ];

        $this
            ->putJson(route('containers.update', $Container->id), $request)
            ->assertJsonFragment([
                'name' => $request['name'],
            ]);

        $this->assertEquals($request['name'], $Container->refresh()->name);
    }

    /** @test */
    public function can_delete_container()
    {
        $Container = $this->container::factory()->create();

        $this->assertCount(2, $this->container::all());

        $this
            ->deleteJson(route('containers.destroy', $Container->id))
            ->assertOk();

        $this->assertCount(1, $this->container::all());
    }
}
