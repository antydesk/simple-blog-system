<?php

namespace App\Swagger\V1\User;

/**
 * @OA\Get(
 *     path="/api/v1/users/{user_id}",
 *     summary="Просмотр информации о пользователе",
 *     description="Возвращает информацию о пользователе по его идентификатору.",
 *     tags={"User"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Информация о пользователе",
 *         @OA\JsonContent(
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="name", type="string", example="Иван Иванов"),
 *             @OA\Property(property="email", type="string", example="ivan@example.com")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Не авторизован",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Unauthenticated")
 *         )
 *     )
 * )
 */
interface UserShowInterface
{
}
