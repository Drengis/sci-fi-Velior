<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @OA\Schema(
 *     schema="Character",
 *     title="Character",
 *     description="Модель персонажа",
 *     type="object",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="user_id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Тарисса Нал"),
 *     @OA\Property(property="class", type="string", example="Stormcaller"),
 *     @OA\Property(property="race", type="string", example="Human"),
 *     @OA\Property(property="background", type="string", example="Wanderer"),
 *     @OA\Property(property="traits", type="string", example="Impulsive, brave"),
 *     @OA\Property(property="ideals", type="string", example="Freedom"),
 *     @OA\Property(property="attachments", type="string", example="Old amulet"),
 *     @OA\Property(property="weaknesses", type="string", example="Overconfidence"),
 *     @OA\Property(property="strength", type="integer", example=10),
 *     @OA\Property(property="dexterity", type="integer", example=10),
 *     @OA\Property(property="constitution", type="integer", example=10),
 *     @OA\Property(property="intelligence", type="integer", example=10),
 *     @OA\Property(property="wisdom", type="integer", example=10),
 *     @OA\Property(property="charisma", type="integer", example=10)
 * )
 */
class Character extends Model
{
    use HasFactory;

    protected $table = 'characters';

    protected $fillable = [
        'user_id',
        'name',
        'class',
        'race',
        'background',
        'traits',
        'ideals',
        'attachments',
        'weaknesses',
        'strength',
        'dexterity',
        'constitution',
        'intelligence',
        'wisdom',
        'charisma',
    ];

    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Расчет модификатора характеристики
     */
    public static function getModifier(int $score): int
    {
        return floor(($score - 10) / 2);
    }

    public function getModifiers(): array
    {
        return [
            'strength' => self::getModifier($this->strength),
            'dexterity' => self::getModifier($this->dexterity),
            'constitution' => self::getModifier($this->constitution),
            'intelligence' => self::getModifier($this->intelligence),
            'wisdom' => self::getModifier($this->wisdom),
            'charisma' => self::getModifier($this->charisma),
        ];
    }
}
