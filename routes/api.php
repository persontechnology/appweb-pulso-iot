<?php

use App\Http\Controllers\Api\GatewayController;
use App\Http\Controllers\SensorDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/sensor-data', [GatewayController::class, 'sensor']);
Route::get('/dato', [GatewayController::class, 'obtenerLecturaActivo']);
Route::post('/enviardato', [GatewayController::class, 'cambiarEstadoLectura']);
