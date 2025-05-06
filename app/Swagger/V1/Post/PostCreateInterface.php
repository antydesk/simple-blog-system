<?php

namespace App\Swagger\V1\Post;

/**
 * @OA\Post(
 *     path="/api/v1/users/{user_id}/posts",
 *     summary="Создать пост",
 *     tags={"Post"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(
 *         name="user_id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"title", "content"},
 *             @OA\Property(property="title", type="string", example="Мой пост"),
 *             @OA\Property(property="content", type="string", example="Текст содержимого поста.")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Пост успешно создан",
 *         @OA\JsonContent(ref="#/components/schemas/PostResource")
 *     )
 * )
 */
interface PostCreateInterface
{
}
