<?php

namespace App\Swagger\V1\Post;

/**
 * @OA\Put(
 *     path="/api/v1/users/{user_id}/posts/{post_id}",
 *     summary="Обновить пост",
 *     tags={"Post"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Parameter(
 *         name="post_id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", example=10)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "content"},
 *             @OA\Property(property="title", type="string", example="Обновлённый заголовок"),
 *             @OA\Property(property="content", type="string", example="Обновлённое содержимое поста.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Пост обновлён",
 *         @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                   property="data",
 *                   ref="#/components/schemas/PostOnlyResource"
 *              )
 *         )
 *     )
 * )
 */
interface PostUpdateInterface
{
}
