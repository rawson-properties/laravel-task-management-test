<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Route::prefix('users')->as('user.')->group(function () {
    Route::prefix('{user}')->group(function () {
        Route::apiResource('tasks', TaskController::class);
    });
    Route::controller(UserController::class)->group(function () {
        Route::post('login', 'login')->name('login');
        Route::post('register', 'register')->withoutMiddleware('auth:sanctum')->name('register');
        Route::delete('logout')->name('logout');
    });
})
    ->middleware(['auth:sanctum']);
//->scopeBindings();
