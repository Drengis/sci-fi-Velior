<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Массово заполняемые поля
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Скрытые поля (не отдаются в API)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Приведение типов
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
