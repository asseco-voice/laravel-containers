<?php

declare(strict_types=1);

namespace Voice\Containers\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Response;
use Voice\Containers\App\Container;

class ContainerController extends Controller
{
    public Container $container;

    public function __construct()
    {
        $this->container = Config::get('asseco-containers.model');
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return Response::json($this->container::all());
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

        return Response::json($container);
    }

    /**
     * Display the specified resource.
     *
     * @param Container $container
     * @return JsonResponse
     */
    public function show(Container $container): JsonResponse
    {
        return Response::json($container);
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
        $isUpdated = $container->update($request->all());

        return Response::json($isUpdated ? 'true' : 'false');
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

        return Response::json($isDeleted ? 'true' : 'false');
    }
}
