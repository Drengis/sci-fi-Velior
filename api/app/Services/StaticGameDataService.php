<?php

namespace App\Services;

use App\Models\Armor;
use Illuminate\Support\Collection;

class StaticGameDataService
{
    /**
     * Вся броня
     */
    public static function armor(): Collection
    {
        return Armor::query()->get();
    }

    /**
     * Броня по ID
     */
    public static function armorById(int $id): ?Armor
    {
        return Armor::query()->find($id);
    }

}
