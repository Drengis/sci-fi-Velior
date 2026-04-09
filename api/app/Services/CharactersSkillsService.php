<?php

namespace App\Services;

use App\Models\Character;
use App\Models\CharactersSkills;
use App\Models\StaticSkills;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class CharactersSkillsService
{
    public function getCharacterSkillsWithValues(Character $character): Collection
    {
        $character->loadMissing('skills');

        $profBonus = $character->proficiency_bonus; 
        $modifiers = $character->getModifiers();
        $staticSkills = Cache::rememberForever('static_skills_all', function () {
            return StaticSkills::all();
        });

        return $staticSkills->map(function (StaticSkills $staticSkill) use ($character, $profBonus, $modifiers) {
            $characterSkill = $character->skills->firstWhere('id', $staticSkill->id);

            $isProficient = $characterSkill ? (bool)$characterSkill->pivot->is_proficient : false;
            $isExpert = $characterSkill ? (bool)$characterSkill->pivot->is_expert : false;

            $baseMod = $modifiers[$staticSkill->ability] ?? 0;

            $totalValue = CharactersSkills::getValue($baseMod, $profBonus, $isProficient, $isExpert);

            return [
                'id' => $staticSkill->id,
                'name' => $staticSkill->name,
                'slug' => $staticSkill->slug,
                'ability' => $staticSkill->ability,
                'is_proficient' => $isProficient,
                'is_expert' => $isExpert,
                'value' => $totalValue,
            ];
        });
    }

    public function syncSkills(Character $character, array $skillsData)
    {
        $syncData = [];
        foreach ($skillsData as $skill) {
            $syncData[$skill['id']] = [
                'is_proficient' => $skill['is_proficient'] ?? false,
                'is_expert' => $skill['is_expert'] ?? false,
            ];
        }

        $character->skills()->sync($syncData);
    }
}