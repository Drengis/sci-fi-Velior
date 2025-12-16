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
 *     @OA\Property(property="weaknesses", type="string", example="Overconfidence")
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
    ];

    // Если нет created_at / updated_at
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
