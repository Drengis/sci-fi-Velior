<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StaticGameDataController;

// Префикс "auth" для всех маршрутов авторизации
Route::prefix('auth')->group(function () {
    // Регистрация
    Route::post('/register', [AuthController::class, 'register']);
    // Логин
    Route::post('/login', [AuthController::class, 'login']);
    // Все защищённые маршруты через Sanctum
    Route::middleware('auth:sanctum')->group(function () {
        // Выход
        Route::post('/logout', [AuthController::class, 'logout']);
        // Получить текущего пользователя
        Route::get('/me', [AuthController::class, 'me']);
    });
});


Route::prefix('static')->group(function () {

    Route::get('/armor', [StaticGameDataController::class, 'index_armor']);

    Route::get('/armor/{id}', [StaticGameDataController::class, 'show_armor']);

});
