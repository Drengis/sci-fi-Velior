<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StaticGameDataController;
use App\Http\Controllers\CharacterController;


Route::prefix('auth')->group(function () {

    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {

        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/me', [AuthController::class, 'me']);
    });
});



Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('characters', CharacterController::class);
    
    Route::get('/users/{userId}/characters', [CharacterController::class, 'getByUser']);
});



Route::prefix('static')->group(function () {

    Route::get('/armor', [StaticGameDataController::class, 'index_armor']);
    Route::get('/armor/{id}', [StaticGameDataController::class, 'show_armor']);

    Route::get('/melee-weapon', [StaticGameDataController::class, 'index_melee_weapon']);
    Route::get('/melee-weapon/{id}', [StaticGameDataController::class, 'show_melee_weapon']);

    Route::get('/range-weapon', [StaticGameDataController::class, 'index_range_weapon']);
    Route::get('/range-weapon/{id}', [StaticGameDataController::class, 'show_range_weapon']);
});
