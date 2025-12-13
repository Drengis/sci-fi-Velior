<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\AuthService;

class AuthController extends BaseController
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    protected function getService(): AuthService
    {
        return $this->authService;
    }

    /**
     * Регистрация пользователя
     */
    public function register(Request $request): JsonResponse
    {
        try {
            $user = $this->authService->register($request->only(['name', 'email', 'password']));

            return $this->successResponse([
                'message' => 'Пользователь успешно зарегистрирован',
                'user'    => $user
            ], 201);

        } catch (\RuntimeException $e) {
            return $this->errorResponse($e->getMessage(), 422);
        }
    }

    /**
     * Логин
     */
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only(['email', 'password']);

        try {
            $authResult = $this->authService->login($credentials);
        } catch (\RuntimeException $e) {
            return $this->errorResponse($e->getMessage(), 401);
        }

        if (!$authResult) {
            return $this->errorResponse('Неверный email или пароль', 401);
        }

        $user = $authResult['user'];

        return $this->successResponse([
            'message' => 'Успешная авторизация',
            'user'    => $user->makeHidden(['password', 'remember_token']),
            'token'   => $authResult['token'],
        ]);
    }

    /**
     * Выход (удаление токена)
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()?->currentAccessToken()?->delete();

        return $this->successResponse([
            'message' => 'Вы вышли из аккаунта'
        ]);
    }

    /**
     * Получить текущего пользователя
     */
    public function me(Request $request): JsonResponse
    {
        return $this->successResponse([
            'user' => $request->user()->makeHidden(['password', 'remember_token']),
        ]);
    }
}
