<?php

declare(strict_types=1);

namespace Asseco\Containers\Tests\Feature;

use Asseco\Containers\App\Models\Container;
use Asseco\Containers\Tests\TestCase;

class ContainerControllerTest extends TestCase
{
    /** @test */
    public function can_fetch_all_containers()
    {
        $this->withExceptionHandling()
            ->getJson(route('containers.index'))
            ->assertJsonCount(0);

        Container::factory()->count(5)->create();

        $this
            ->getJson(route('containers.index'))
            ->assertJsonCount(5);

        $this->assertCount(5, Container::all());
    }

    /** @test */
    public function creates_container()
    {
        $request = Container::factory()->make()->toArray();

        $this
            ->postJson(route('containers.store'), $request)
            ->assertJsonFragment([
                'id'   => 1,
                'name' => $request['name'],
            ]);

        $this->assertCount(1, Container::all());
    }

    /** @test */
    public function can_return_container_by_id()
    {
        Container::factory()->count(5)->create();

        $this
            ->getJson(route('containers.show', 3))
            ->assertJsonFragment(['id' => 3]);
    }

    /** @test */
    public function can_update_container()
    {
        $Container = Container::factory()->create();

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
        $Container = Container::factory()->create();

        $this->assertCount(1, Container::all());

        $this
            ->deleteJson(route('containers.destroy', $Container->id))
            ->assertOk();

        $this->assertCount(0, Container::all());
    }
}
