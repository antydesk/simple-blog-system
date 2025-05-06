<?php

namespace App\Swagger\V1\Post;

/**
 * @OA\Get(
 *     path="/api/v1/users/{user_id}/posts/{post_id}",
 *     summary="Получить один пост",
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
 *     @OA\Response(
 *         response=200,
 *         description="Информация о посте",
 *         @OA\JsonContent(ref="#/components/schemas/PostResource")
 *     )
 * )
 */
interface PostShowInterface
{
}
