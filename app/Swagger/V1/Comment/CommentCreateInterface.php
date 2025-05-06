<?php

namespace App\Swagger\V1\Comment;

/**
 * @OA\Post (
 *     path="/api/v1/users/{user_id}/posts/{post_id}/comments",
 *     summary="Создать коммент",
 *     tags={"Comment"},
 *     security={{"bearerAuth": {}}},
 *
 *     @OA\Parameter (
 *         name="user_id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\Parameter (
 *         name="post_id",
 *         in="path",
 *         required=true,
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent (
 *             required={"content"},
 *             @OA\Property(property="content", type="string", example="Мой первый коммит"),
 *             @OA\Property(property="parent_id", type="integer", example=1)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Комментарий успешно создан"
 *     )
 * )
 */
interface CommentCreateInterface
{
}
