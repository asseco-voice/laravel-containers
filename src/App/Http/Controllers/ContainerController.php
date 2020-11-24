<?php

declare(strict_types=1);

namespace Voice\Containers\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Voice\Containers\App\Container;

class ContainerController extends Controller
{
    public Container $container;

    public function __construct()
    {
        $model = config('asseco-containers.model');
        $this->container = new $model;
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
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $container = $this->container::query()->create($request->all());

        return response()->json($container->refresh());
    }

    /**
     * Display the specified resource.
     *
     * @param Container $container
     * @return JsonResponse
     */
    public function show(Container $container): JsonResponse
    {
        return response()->json($container);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Container $container
     * @return JsonResponse
     */
    public function update(Request $request, Container $container): JsonResponse
    {
        $container->update($request->all());

        return response()->json($container->refresh());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Container $container
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Container $container): JsonResponse
    {
        $isDeleted = $container->delete();

        return response()->json($isDeleted ? 'true' : 'false');
    }
}
