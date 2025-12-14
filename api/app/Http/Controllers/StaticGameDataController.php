<?php

namespace App\Http\Controllers;

use App\Services\StaticGameDataService;
use Illuminate\Http\JsonResponse;

class StaticGameDataController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/static/armor",
     *     summary="Получить всю броню",
     *     tags={"Static"},
     *     @OA\Response(
     *         response=200,
     *         description="Список брони",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Titan Armor"),
     *                 @OA\Property(property="upgrade_slots", type="integer", example=3),
     *                 @OA\Property(property="descripsion", type="string", example="Heavy sci-fi armor")
     *             )
     *         )
     *     )
     * )
     */
    public function index_armor(): JsonResponse
    {
        return response()->json(
            StaticGameDataService::armor()
        );
    }

    /**
     * @OA\Get(
     *     path="/api/static/armor/{id}",
     *     summary="Получить броню по ID",
     *     tags={"Static"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID брони",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Данные брони",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Titan Armor"),
     *                 @OA\Property(property="upgrade_slots", type="integer", example=3),
     *                 @OA\Property(property="descripsion", type="string", example="Heavy sci-fi armor")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Броня не найдена",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Armor not found")
     *         )
     *     )
     * )
     */
    public function show_armor(int $id): JsonResponse
    {
        $armor = StaticGameDataService::armorById($id);

        if (!$armor) {
            return response()->json([
                'message' => 'Armor not found'
            ], 404);
        }

        return response()->json($armor);
    }

    /**
     * @OA\Get(
     *     path="/api/static/melee-weapon",
     *     summary="Получить всё мили-оружие",
     *     tags={"Static"},
     *     @OA\Response(
     *         response=200,
     *         description="Список мили-оружия",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *              @OA\Property(property="id", type="integer", example=1),
     *              @OA\Property(property="title", type="string", example="Plasma Sword"),
     *              @OA\Property(property="vs_MK1", type="string", example="+2"),
     *              @OA\Property(property="vs_MK2", type="string", example="+1"),
     *              @OA\Property(property="vs_MK3", type="string", example="Полностью"),
     *              @OA\Property(property="vs_MK4", type="string", example="Половина")
     *             )
     *         )
     *     )
     * )
     */
    public function index_melee_weapon(): JsonResponse
    {
        return response()->json(
            StaticGameDataService::melee_weapon()
        );
    }

    /**
     * @OA\Get(
     *     path="/api/static/melee-weapon/{id}",
     *     summary="Получить мили-оружие по ID",
     *     tags={"Static"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID оружия",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Данные мили-оружия",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="title", type="string", example="Plasma Sword"),
     *             @OA\Property(property="vs_MK1", type="string", example="+2"),
     *             @OA\Property(property="vs_MK2", type="string", example="+1"),
     *             @OA\Property(property="vs_MK3", type="string", example="Полностью"),
     *             @OA\Property(property="vs_MK4", type="string", example="Половина")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Оружие не найдено",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="melee weapon not found")
     *         )
     *     )
     * )
     */
    public function show_melee_weapon(int $id): JsonResponse
    {
        $weapon = StaticGameDataService::melee_weaponById($id);

        if (!$weapon) {
            return response()->json([
                'message' => 'melee weapon not found'
            ], 404);
        }

        return response()->json($weapon);
    }
}
