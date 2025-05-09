<?php

namespace App\Swagger\V1\Comment;


/**
 * @OA\Get(
 *     path="/api/v1/users/{user_id}/posts/{post_id}/comments",
 *     summary="Получить список комментариев",
 *     tags={"Comment"},
 *     security={{"bearerAuth": {}}},
 *     @OA\Parameter(name="user_id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Parameter(name="post_id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Parameter(name="page", in="query", required=false, @OA\Schema(type="integer")),
 *     @OA\Parameter(name="per_page", in="query", required=false, @OA\Schema(type="integer")),
 *     @OA\Parameter(name="q", in="query", required=false, @OA\Schema(type="string")),
 *     @OA\Response(
 *         response=200,
 *         description="Список комментариев",
 *         @OA\JsonContent(
 *               type="object",
 *               @OA\Property(
 *                    property="data",
 *                    ref="#/components/schemas/CommentPaginatedResource"
 *               )
 *          )
 *     )
 * )
 */
interface CommentIndexInterface
{
}
