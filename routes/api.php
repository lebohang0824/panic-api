<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PanicController;
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


// Authenticate
Route::post('/login', [AuthController::class, 'login']);

// Panic related routes
Route::prefix('/panic')->middleware('auth:sanctum')->group(function () {
    Route::controller(PanicController::class)->group(function () {
        // Send a new panic
        Route::post('/', 'send');

        // Cancel panic by id
        Route::post('/{id}', 'cancel')->whereNumber('id');

        // Panic history
        Route::get('/', 'history');
    });
});
