<?php

namespace App\Swagger\V1\Post;

/**
 * @OA\Get(
 *     path="/api/v1/users/{user_id}/posts",
 *     operationId="getUserPosts",
 *     summary="Получить список постов пользователя",
 *     description="Возвращает список всех постов, принадлежащих указанному пользователю",
 *     tags={"Post"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         description="ID пользователя, чьи посты нужно получить",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             example=1
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Успешный ответ. Список постов пользователя.",
 *          @OA\JsonContent(
 *              type="array",
 *              @OA\Items(ref="#/components/schemas/PostResource")
 *          )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Неавторизован"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Пользователь не найден"
 *     )
 * )
 */
interface PostIndexInterface
{
}
