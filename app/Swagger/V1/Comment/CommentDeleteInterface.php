<?php

namespace App\Swagger\V1\Comment;

/**
 * @OA\Delete(
 *     path="/api/v1/users/{user_id}/posts/{post_id}/comments/{comment_id}",
 *     summary="Удалить комментарий",
 *     tags={"Comment"},
 *     security={{"bearerAuth": {}}},
 *
 *     @OA\Parameter(name="user_id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Parameter(name="post_id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Parameter(name="comment_id", in="path", required=true, @OA\Schema(type="integer")),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Комментарий успешно удален",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="Comment deleted successfully.")
 *         )
 *     )
 * )
 */
interface CommentDeleteInterface {}
