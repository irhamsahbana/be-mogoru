<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\{
    AuthController,
    GetCitiesController
};

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

Route::middleware('auth:sanctum')->group(function() {
    Route::get('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/logout-all-devices', [AuthController::class, 'logoutAll']);
});

Route::post("auth/login", [AuthController::class, 'attempt']);
// Route::get('seed-provinces-cities', [GetCitiesController::class, 'ProvincesAndCities']);
