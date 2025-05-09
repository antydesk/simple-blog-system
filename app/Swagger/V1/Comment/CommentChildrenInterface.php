<?php

namespace App\Swagger\V1\Comment;


/**
 * @OA\Get(
 *     path="/api/v1/users/{user_id}/posts/{post_id}/comments/{comment_id}/children",
 *     summary="Получить дочерние комментарии",
 *     tags={"Comment"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(name="user_id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Parameter(name="post_id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Parameter(name="comment_id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(
 *         response=200,
 *         description="Список дочерних комментариев",
 *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/CommentPaginatedResource"))
 *     )
 * )
 */

interface CommentChildrenInterface
{
}
