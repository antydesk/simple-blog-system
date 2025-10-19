<?php

namespace App\Swagger\V1\User;

/**
 * @OA\Delete(
 *     path="/api/v1/users/{user_id}",
 *     summary="Удаление пользователя",
 *     description="Удаляет пользователя по его идентификатору.",
 *     tags={"User"},
 *     security={{"bearerAuth": {}}},
 *
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Пользователь успешно удалён",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="User deleted successfully")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Не авторизован",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="Unauthenticated")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Пользователь не найден",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="User not found")
 *         )
 *     )
 * )
 */
interface UserDestroyInterface {}
