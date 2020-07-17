<?php

use Illuminate\Support\Facades\Route;
use Voice\Containers\App\Http\Controllers\ContainerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('api/containers/search', ContainerController::class . '@search')->name('containers.search');

Route::apiResource('api/containers', ContainerController::class);
