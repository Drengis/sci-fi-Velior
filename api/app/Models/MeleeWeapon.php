<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeleeWeapon extends Model
{
    protected $table = 'melee_weapons';

    protected $fillable = [
        'title',
        'vs_MK1',
        'vs_MK2',
        'vs_MK3',
        'vs_MK4',
    ];

    public $timestamps = false;
}
