<?php

namespace App\Swagger\V1\Like\LikePost;

/**
 * @OA\Get(
 *     path="/api/v1/users/{user_id}/posts/{post_id}/likes",
 *     operationId="getPostLikes",
 *     summary="Получить список лайков поста",
 *     description="Возвращает список всех лайков, принадлежащих указанному посту",
 *     tags={"Like"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter (
 *         name="user_id",
 *         in="path",
 *         description="ID пользователя, которому принадлежит пост",
 *         required=true,
 *         @OA\Schema (
 *             type="integer",
 *             example=1
 *         )
 *     ),
 *     @OA\Parameter (
 *         name="post_id",
 *         in="path",
 *         description="ID поста",
 *         required=true,
 *         @OA\Schema (
 *             type="integer",
 *             example=42
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Успешный ответ. Список лайков поста.",
 *         @OA\JsonContent(ref="#/components/schemas/LikePostResource")
 *     )
 * )
 */
interface LikePostIndexInterface
{
}
