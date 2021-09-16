<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

// --------------------------------------------------------------------
// AUTHENTICATED AREA
// --------------------------------------------------------------------
Route::group(['middleware' => ['apiJwt']], function(){
    
    // --------------------------------------------------------------------
    // DATA CURRENT USER AUTHENTICATED
    // --------------------------------------------------------------------
    Route::group(["/auth" => "/user"],function(){
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::post('/me', [AuthController::class, 'me']);
    });

    // --------------------------------------------------------------------
    // MANAGER USERS
    // --------------------------------------------------------------------
    Route::group(["prefix" => "/user"],function(){
        Route::get('/', [UserController::class, 'index'])->name('user/get');
        Route::post('/store', [UserController::class, 'index'])->name('user/get');
        Route::put('/update', [UserController::class, 'index'])->name('user/get');
        Route::delete('/delete', [UserController::class, 'index'])->name('user/get');
    });

    // --------------------------------------------------------------------
    // MANAGER PRODUCTS
    // --------------------------------------------------------------------
    Route::group(["prefix" => "/product"],function(){
        Route::get('/', [UserController::class, 'index'])->name('user/get');
        Route::post('/store', [UserController::class, 'index'])->name('user/get');
        Route::put('/update', [UserController::class, 'index'])->name('user/get');
        Route::delete('/delete', [UserController::class, 'index'])->name('user/get');
    });
});
