<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Armor extends Model
{
    protected $table = 'armor';

    protected $fillable = [
        'name',
        'upgrade_slots',
        'descripsion',
    ];

    public $timestamps = false;
}
