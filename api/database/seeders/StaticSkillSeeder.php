<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaticSkillSeeder extends Seeder
{
    public function run(): void
    {
        $skills = [
            // Сила
            ['name' => 'Атлетика', 'slug' => 'athletics', 'ability' => 'strength'],
            // Ловкость
            ['name' => 'Акробатика', 'slug' => 'acrobatics', 'ability' => 'dexterity'],
            ['name' => 'Ловкость рук', 'slug' => 'sleight_of_hand', 'ability' => 'dexterity'],
            ['name' => 'Скрытность', 'slug' => 'stealth', 'ability' => 'dexterity'],
            // Интеллект
            ['name' => 'Технология', 'slug' => 'technology', 'ability' => 'intelligence'],
            ['name' => 'История', 'slug' => 'history', 'ability' => 'intelligence'],
            ['name' => 'Анализ', 'slug' => 'investigation', 'ability' => 'intelligence'],
            ['name' => 'Природа', 'slug' => 'nature', 'ability' => 'intelligence'],
            // Мудрость
            ['name' => 'Элементализм', 'slug' => 'elementalism', 'ability' => 'wisdom'],
            ['name' => 'Уход за животными', 'slug' => 'animal_handling', 'ability' => 'wisdom'],
            ['name' => 'Проницательность', 'slug' => 'insight', 'ability' => 'wisdom'],
            ['name' => 'Медицина', 'slug' => 'medicine', 'ability' => 'wisdom'],
            ['name' => 'Внимательность', 'slug' => 'perception', 'ability' => 'wisdom'],
            ['name' => 'Выживание', 'slug' => 'survival', 'ability' => 'wisdom'],
            // Харизма
            ['name' => 'Обман', 'slug' => 'deception', 'ability' => 'charisma'],
            ['name' => 'Запугивание', 'slug' => 'intimidation', 'ability' => 'charisma'],
            ['name' => 'Выступление', 'slug' => 'performance', 'ability' => 'charisma'],
            ['name' => 'Убеждение', 'slug' => 'persuasion', 'ability' => 'charisma'],
        ];

        DB::table('static_skills')->insert($skills);
    }
}