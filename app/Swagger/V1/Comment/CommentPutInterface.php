<?php

namespace App\Swagger\V1\Comment;

/**
 * @OA\Put(
 *     path="/api/v1/users/{user_id}/posts/{post_id}/comments/{comment_id}",
 *     summary="Обновить комментарий",
 *     tags={"Comment"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(name="user_id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Parameter(name="post_id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Parameter(name="comment_id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="content", type="string", example="Обновленный текст комментария")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Комментарий успешно обновлен",
 *         @OA\JsonContent(
 *               type="object",
 *               @OA\Property(
 *                    property="data",
 *                    ref="#/components/schemas/CommentOnlyResource"
 *               )
 *          )
 *     )
 * )
 */
interface CommentPutInterface
{
}
