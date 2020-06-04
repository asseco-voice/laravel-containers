<?php

namespace Voice\Containers\App\Http\Controllers;

use Illuminate\Http\Request;
use Voice\Containers\App\Container;

class ContainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\\Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Container::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\\Illuminate\Http\Request $request
     * @return \Illuminate\Http\\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $container = Container::create($request->all());

        return response()->json($container);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Container $container
     * @return \Illuminate\Http\\Illuminate\Http\Response
     */
    public function show(Container $container)
    {
        return response()->json($container);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\\Illuminate\Http\Request $request
     * @param \App\Container $container
     * @return \Illuminate\Http\\Illuminate\Http\Response
     */
    public function update(Request $request, Container $container)
    {
        $isUpdated = $container->update($request->all());

        return response()->json($isUpdated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Container $container
     * @return \Illuminate\Http\\Illuminate\Http\Response
     */
    public function destroy(Container $container)
    {
        $isDeleted = $container->delete();

        return response()->json($isDeleted);
    }
}
