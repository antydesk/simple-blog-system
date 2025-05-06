<?php

namespace App\Swagger\V1\User;

/**
 * @OA\Put(
 *     path="/api/v1/users/{user_id}",
 *     summary="Обновление пользователя",
 *     description="Обновление данных пользователя",
 *     tags={"User"},
 *     security={{"bearerAuth": {}}},
 *
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"email", "name"},
 *             @OA\Property(property="email", type="string", format="email", example="bob@example.com"),
 *             @OA\Property(property="name", type="string", example="Bob")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Информация о пользователе",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="Иван Иванов"),
 *                 @OA\Property(property="email", type="string", example="ivan@example.com")
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Не авторизован",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Unauthenticated")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Ошибка валидации",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Поле email уже существует."),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(property="email", type="array", @OA\Items(type="string", example="Поле email обязательно."))
 *             )
 *         )
 *     )
 * )
 */
interface UserUpdateInterface
{
}
