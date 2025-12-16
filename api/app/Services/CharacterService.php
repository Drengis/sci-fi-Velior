<?php

namespace App\Services;

use App\Models\Character;

class CharacterService extends BaseService
{
    /**
     * Указываем модель для работы
     */
    protected function getModel(): string
    {
        return Character::class;
    }

    /**
     * Можно добавить специфические методы для персонажей
     */

    /**
     * Получить всех персонажей конкретного пользователя
     */
    public function getByUserId(int $userId, array $relations = [], bool $paginate = false, int $perPage = 15)
    {
        $query = $this->getModel()::with($relations)
            ->where('user_id', $userId);

        return $paginate ? $query->paginate($perPage) : $query->get();
    }

    /**
     * Найти персонажа по имени (LIKE)
     */
    public function findByName(string $name, array $relations = [])
    {
        return $this->getModel()::with($relations)
            ->where('name', 'like', "%{$name}%")
            ->get();
    }
}
