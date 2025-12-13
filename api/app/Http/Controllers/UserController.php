<?php

namespace App\Controllers;

use App\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends BaseController
{
    protected UserServiceInterface $service;

    public function __construct(UserServiceInterface $service)
    {
        $this->service = $service;
    }

    protected function getService(): UserServiceInterface
    {
        return $this->service;
    }

    protected function getValidationRules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            // Добавь другие поля при необходимости
        ];
    }


}
