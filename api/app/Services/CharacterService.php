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
     * Получить персонажа по ID с рассчитанными навыками
     */
    public function getById(int $id, array $relations = []): Character
    {
        /** @var Character $character */
        $character = parent::getById($id, $relations);

        return $character;
    }

    /**
     * Получить всех персонажей конкретного пользов ателя
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
