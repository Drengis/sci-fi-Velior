<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class UserService extends BaseService
{
    protected function getModel(): string
    {
        return User::class;
    }

    public function getAllUsers(): \Illuminate\Database\Eloquent\Collection
    {
        return User::all();
    }

    public function getUserById(int $id): ?Users
    {
        return User::find($id);
    }


}
