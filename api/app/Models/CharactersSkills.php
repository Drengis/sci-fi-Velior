<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\StaticSkills;

class CharactersSkills extends Model
{
    protected $table = 'characters_skills';
    public $timestamps = true;

    protected $fillable = [
        'character_id',
        'static_skill_id',
        'is_proficient',
        'is_expert',
    ];

    public function character()
    {
        return $this->belongsTo(Character::class);
    }

    public function staticSkill()
    {
        return $this->belongsTo(StaticSkills::class);
    }

    public static function getValue($base_mod, $prof_bonus, $is_proficient, $is_expert)
    {
        $total_value = $base_mod;
        if ($is_expert) {
            $total_value += ($prof_bonus * 2);
        } elseif ($is_proficient) {
            $total_value += $prof_bonus;
        }   
        return $total_value;
    }
}
