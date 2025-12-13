<?php

use Illuminate\Support\Facades\Route;
use App\Controllers\AuthController;

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
