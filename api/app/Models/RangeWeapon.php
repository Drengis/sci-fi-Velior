<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RangeWeapon extends Model
{
    protected $table = 'range_weapons';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'armor_penetration',
        'description',
    ];
}
