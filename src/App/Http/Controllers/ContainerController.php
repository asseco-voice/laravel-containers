<?php

declare(strict_types=1);

namespace Asseco\Containers\App\Http\Controllers;

use Asseco\Containers\App\Contracts\Container as ContainerContract;
use Asseco\Containers\App\Http\Requests\ContainerRequest;
use Asseco\Containers\App\Models\Container;
use Exception;
use Illuminate\Http\JsonResponse;

class ContainerController extends Controller
{
    public ContainerContract $container;

    public function __construct(ContainerContract $container)
    {
        $this->container = $container;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json($this->container::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ContainerRequest  $request
     * @return JsonResponse
     */
    public function store(ContainerRequest $request): JsonResponse
    {
        $container = $this->container::query()->create($request->validated());

        return response()->json($container->refresh());
    }

    /**
     * Display the specified resource.
     *
     * @param  Container  $container
     * @return JsonResponse
     */
    public function show(Container $container): JsonResponse
    {
        return response()->json($container);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ContainerRequest  $request
     * @param  Container  $container
     * @return JsonResponse
     */
    public function update(ContainerRequest $request, Container $container): JsonResponse
    {
        $container->update($request->validated());

        return response()->json($container->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Container  $container
     * @return JsonResponse
     *
     * @throws Exception
     */
    public function destroy(Container $container): JsonResponse
    {
        $isDeleted = $container->delete();

        return response()->json($isDeleted ? 'true' : 'false');
    }
}
