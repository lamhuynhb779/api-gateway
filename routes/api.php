<?php

use App\Http\Controllers\Auth\ApiAuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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

Route::group(['middleware' => ['cors', 'json.response'], 'namespace' => 'Auth',], function () {
    // Public routes
    Route::post('/login', [ApiAuthController::class, 'login'])->name('login.api');
    Route::post('/register',[ApiAuthController::class, 'register'])->name('register.api');
});

// Protected routes
Route::group([
    'middleware' => ['auth:api'],
], function () {

    Route::group(['middleware' => ['cors', 'json.response'], 'namespace' => 'Auth',], function () {
        Route::post('/logout', [ApiAuthController::class, 'logout'])->name('logout.api');
    });
    Route::get('/user', [\App\Http\Controllers\UserController::class, 'show'])->name('login.api');


    // Internal Service API
    Route::group([], function () {
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', [ProductController::class, 'index']);
            Route::post('/', [ProductController::class, 'store']);
            Route::get('/{id}', [ProductController::class, 'show']);
            Route::patch('/{id}', [ProductController::class, 'update']);
            Route::delete('/{id}', [ProductController::class, 'destroy']);
        });
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', [OrderController::class, 'index']);
            Route::post('/', [OrderController::class, 'store']);
            Route::get('/{id}', [OrderController::class, 'show']);
            Route::patch('/{id}', [OrderController::class, 'update']);
            Route::delete('/{id}', [OrderController::class, 'destroy']);
        });
    });


});
