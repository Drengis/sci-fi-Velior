<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;
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

    protected function getValidationRules(bool $forCreate = true): array
    {
        return [];
    }

    /**
     * @OA\Post(
     *     path="/api/auth/register",
     *     summary="Регистрация пользователя",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","email","password"},
     *             @OA\Property(property="name", type="string", example="Alex"),
     *             @OA\Property(property="email", type="string", example="alex@mail.com"),
     *             @OA\Property(property="password", type="string", example="12345678")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Успешная регистрация",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="user", type="object")
     *         )
     *     ),
     *     @OA\Response(response=422, description="Ошибка регистрации")
     * )
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
     * @OA\Post(
     *     path="/api/auth/login",
     *     summary="Авторизация пользователя",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email","password"},
     *             @OA\Property(property="email", type="string", example="alex@mail.com"),
     *             @OA\Property(property="password", type="string", example="12345678")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешная авторизация",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string"),
     *             @OA\Property(property="user", type="object"),
     *             @OA\Property(property="token", type="string")
     *         )
     *     ),
     *     @OA\Response(response=401, description="Неверный email или пароль")
     * )
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
     * @OA\Post(
     *     path="/api/auth/logout",
     *     summary="Выход пользователя (удаление токена)",
     *     tags={"Auth"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Успешный выход",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string")
     *         )
     *     )
     * )
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()?->currentAccessToken()?->delete();

        return $this->successResponse([
            'message' => 'Вы вышли из аккаунта'
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/auth/me",
     *     summary="Получить текущего пользователя",
     *     tags={"Auth"},
     *     security={{"sanctum": {}}},
     *     @OA\Response(
     *         response=200,
     *         description="Информация о текущем пользователе",
     *         @OA\JsonContent(
     *             @OA\Property(property="user", type="object")
     *         )
     *     )
     * )
     */
    public function me(Request $request): JsonResponse
    {
        return $this->successResponse([
            'user' => $request->user()->makeHidden(['password', 'remember_token']),
        ]);
    }
}
