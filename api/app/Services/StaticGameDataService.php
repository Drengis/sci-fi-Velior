<?php

namespace App\Services;

use App\Models\Armor;
use App\Models\MeleeWeapon;
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

    /**
     * Все мили оружия
     */
    public static function melee_weapon(): Collection
    {
        return MeleeWeapon::query()->get();
    }

    /**
     * Броня по ID
     */
    public static function melee_weaponById(int $id): ?MeleeWeapon
    {
        return MeleeWeapon::query()->find($id);
    }


}
