<?php

namespace App\Http\Controllers;

use App\Services\CharacterService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Characters",
 *     description="API для работы с персонажами"
 * )
 */
class CharacterController extends BaseController
{
    protected CharacterService $service;

    public function __construct(CharacterService $service)
    {
        $this->service = $service;
    }

    protected function getService()
    {
        return $this->service;
    }

    protected function getValidationRules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:45',
            'class' => 'nullable|string|max:45',
            'race' => 'nullable|string|max:45',
            'background' => 'nullable|string|max:45',
            'traits' => 'nullable|string|max:255',
            'ideals' => 'nullable|string|max:255',
            'attachments' => 'nullable|string|max:255',
            'weaknesses' => 'nullable|string|max:255',
        ];
    }

    // -------------------------------
    // CRUD аннотации для BaseController
    // -------------------------------

    /**
     * @OA\Get(
     *     path="/api/characters",
     *     summary="Получить список всех персонажей",
     *     tags={"Characters"},
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         required=false,
     *         description="Количество записей на страницу",
     *         @OA\Schema(type="integer", example=15)
     *     ),
     *     @OA\Parameter(
     *         name="with",
     *         in="query",
     *         required=false,
     *         description="Связи для подгрузки через запятую",
     *         @OA\Schema(type="string", example="user")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список персонажей",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Character")
     *             )
     *         )
     *     )
     * )
     */
    public function index(Request $request): JsonResponse
    {
        return parent::index($request);
    }

    /**
     * @OA\Get(
     *     path="/api/characters/{id}",
     *     summary="Получить персонажа по ID",
     *     tags={"Characters"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID персонажа",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Данные персонажа",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", ref="#/components/schemas/Character")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Персонаж не найден",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Character not found")
     *         )
     *     )
     * )
     */
    public function show(int $id, Request $request): JsonResponse
    {
        return parent::show($id, $request);
    }

    /**
     * @OA\Post(
     *     path="/api/characters",
     *     summary="Создать нового персонажа",
     *     tags={"Characters"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"user_id","name"},
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Тарисса Нал"),
     *             @OA\Property(property="class", type="string", example="Stormcaller"),
     *             @OA\Property(property="race", type="string", example="Human"),
     *             @OA\Property(property="background", type="string", example="Wanderer"),
     *             @OA\Property(property="traits", type="string", example="Impulsive, brave"),
     *             @OA\Property(property="ideals", type="string", example="Freedom"),
     *             @OA\Property(property="attachments", type="string", example="Old amulet"),
     *             @OA\Property(property="weaknesses", type="string", example="Overconfidence")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Персонаж создан",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", ref="#/components/schemas/Character")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function store(Request $request): JsonResponse
    {
        return parent::store($request);
    }

    /**
     * @OA\Put(
     *     path="/api/characters/{id}",
     *     summary="Обновить персонажа",
     *     tags={"Characters"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID персонажа",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Тарисса Нал"),
     *             @OA\Property(property="class", type="string", example="Warrior")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Персонаж обновлен",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", ref="#/components/schemas/Character")
     *         )
     *     )
     * )
     */
    public function update(Request $request, int $id): JsonResponse
    {
        return parent::update($request, $id);
    }

    /**
     * @OA\Delete(
     *     path="/api/characters/{id}",
     *     summary="Удалить персонажа",
     *     tags={"Characters"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID персонажа",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Персонаж удален"
     *     )
     * )
     */
    public function destroy(int $id): JsonResponse
    {
        return parent::destroy($id);
    }

    // --------------------------------------
    // Дополнительные методы, специфичные для персонажей
    // --------------------------------------

    /**
     * Получить всех персонажей конкретного пользователя
     *
     * @OA\Get(
     *     path="/api/users/{userId}/characters",
     *     summary="Получить всех персонажей пользователя",
     *     tags={"Characters"},
     *     @OA\Parameter(
     *         name="userId",
     *         in="path",
     *         required=true,
     *         description="ID пользователя",
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Список персонажей пользователя",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Character")
     *             )
     *         )
     *     )
     * )
     */
    public function getByUser(int $userId, Request $request)
    {
        $perPage = $request->input('per_page', 15);
        $relations = $request->input('with', []);

        $characters = $this->service->getByUserId(
            userId: $userId,
            relations: is_array($relations) ? $relations : explode(',', $relations),
            paginate: true,
            perPage: $perPage
        );

        return $this->successResponse($characters);
    }

    /**
     * Найти персонажа по имени
     *
     * @OA\Get(
     *     path="/api/characters/search",
     *     summary="Найти персонажей по имени",
     *     tags={"Characters"},
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=true,
     *         description="Имя персонажа для поиска",
     *         @OA\Schema(type="string", example="Тарисса")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Найденные персонажи",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="data", type="array",
     *                 @OA\Items(ref="#/components/schemas/Character")
     *             )
     *         )
     *     )
     * )
     */
    public function search(Request $request)
    {
        $name = $request->query('name');

        if (!$name) {
            return $this->errorResponse('Parameter "name" is required', 422);
        }

        $relations = $request->input('with', []);
        $characters = $this->service->findByName(
            $name,
            is_array($relations) ? $relations : explode(',', $relations)
        );

        return $this->successResponse($characters);
    }
}
