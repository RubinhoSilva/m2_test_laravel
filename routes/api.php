<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\GroupCitiesController;
use Illuminate\Support\Facades\Route;

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

Route::prefix('group_cities')->group(function () {
    Route::post('/', [GroupCitiesController::class, 'store']);
    Route::get('/', [GroupCitiesController::class, 'index']);
    Route::get('/{id}', [GroupCitiesController::class, 'show']);
    Route::put('/{id}', [GroupCitiesController::class, 'update']);
    Route::delete('/{id}', [GroupCitiesController::class, 'delete']);
});

Route::prefix('cities')->group(function () {
    Route::post('/', [CityController::class, 'store']);
    Route::get('/', [CityController::class, 'index']);
    Route::get('/{id}', [CityController::class, 'show']);
    Route::put('/{id}', [CityController::class, 'update']);
    Route::delete('/{id}', [CityController::class, 'delete']);
});
