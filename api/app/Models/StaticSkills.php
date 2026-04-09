<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaticSkills extends Model
{
    protected $table = 'static_skills';
    public $timestamps = true;

    protected $fillable = [
        'name',
        'slug',
        'ability',
    ];

    public function characters()
    {
        return $this->belongsToMany(Character::class, 'characters_skills')
                    ->withPivot('is_proficient', 'is_expert')
                    ->withTimestamps();
    }

}
