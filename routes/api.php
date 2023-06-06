<?php

use Illuminate\Http\Request;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Public
Route::post('/login', [\App\Http\Controllers\API\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\API\AuthController::class, 'register']);

Route::group([
    'middleware' => 'auth:api',
], function() {
    // Auth
    Route::get('/profile', [\App\Http\Controllers\API\AuthController::class, 'profile']);
    Route::post('/logout', [\App\Http\Controllers\API\AuthController::class, 'logout']);

    // Kendaraan
    Route::prefix('kendaraan')->group(function() {
        Route::get('/', [\App\Http\Controllers\API\KendaraanController::class, 'all']);
        Route::post('/', [\App\Http\Controllers\API\KendaraanController::class, 'create']);
        Route::put('/{id}', [\App\Http\Controllers\API\KendaraanController::class, 'update']);
        Route::delete('/{id}', [\App\Http\Controllers\API\KendaraanController::class, 'delete']);
        Route::get('/{id}', [\App\Http\Controllers\API\KendaraanController::class, 'read']);
    });

    // Order
    Route::prefix('order')->group(function() {
        Route::post('/', [\App\Http\Controllers\API\OrderController::class, 'create']);
        Route::post('/{id}/paid', [\App\Http\Controllers\API\OrderController::class, 'paid']);
    });
});