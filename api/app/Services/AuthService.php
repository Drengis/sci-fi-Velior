<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthService
{
    /**
     * Проверка доступности email
     */
    public function isEmailAvailable(string $email): bool
    {
        return !User::where('email', $email)->exists();
    }

    /**
     * Проверка доступности имени
     */
    public function isNameAvailable(string $name): bool
    {
        return !User::where('name', $name)->exists();
    }

    /**
     * Регистрация пользователя
     *
     * @param array $data ['name', 'email', 'password']
     * @return User
     */
    public function register(array $data): User
    {
        if (!$this->isEmailAvailable($data['email'])) {
            throw new \RuntimeException('Email уже зарегистрирован');
        }

        if (!$this->isNameAvailable($data['name'])) {
            throw new \RuntimeException('Имя пользователя уже занято');
        }

        /** @var User $user */
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }

    /**
     * Авторизация пользователя
     *
     * @param array $credentials ['email', 'password']
     * @return array|null ['user' => User, 'token' => string] или null
     */
    public function login(array $credentials): ?array
    {
        $user = User::where('email', $credentials['email'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return null;
        }

        // Создаем токен для Sanctum
        $token = $user->createToken('auth-token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    /**
     * Проверка пароля (если нужно отдельно)
     */
    public function checkPassword(User $user, string $password): bool
    {
        return Hash::check($password, $user->password);
    }
}
