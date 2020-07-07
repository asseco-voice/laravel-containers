<?php

namespace Voice\Containers\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Voice\Containers\App\Container;

class ContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(Container::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $container = Container::create($request->all());

        return response()->json($container);
    }

    /**
     * Display the specified resource.
     *
     * @param Container $container
     * @return JsonResponse
     */
    public function show(Container $container)
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
    public function update(Request $request, Container $container)
    {
        $isUpdated = $container->update($request->all());

        return response()->json($isUpdated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Container $container
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Container $container)
    {
        $isDeleted = $container->delete();

        return response()->json($isDeleted);
    }

    /**
     * Search the resource using search API engine
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request)
    {
        return response()->json(Container::search($request));
    }
}
