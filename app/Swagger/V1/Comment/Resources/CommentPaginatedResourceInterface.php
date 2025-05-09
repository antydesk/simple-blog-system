<?php

namespace App\Swagger\V1\Comment\Resources;

/**
 * @OA\Schema(
 *     schema="CommentPaginatedResource",
 *     title="CommentPaginatedResource",
 *     description="Пагинированный список комментариев",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/CommentOnlyResource")
 *     ),
 *     @OA\Property(
 *         property="links",
 *         type="object",
 *         @OA\Property(property="first", type="string", example="http://127.0.0.1:8000/api/v1/posts/10/comments?page=1"),
 *         @OA\Property(property="last", type="string", example="http://127.0.0.1:8000/api/v1/posts/10/comments?page=1"),
 *         @OA\Property(property="prev", type="string", nullable=true, example=null),
 *         @OA\Property(property="next", type="string", nullable=true, example=null)
 *     ),
 *     @OA\Property(
 *         property="meta",
 *         type="object",
 *         @OA\Property(property="current_page", type="integer", example=1),
 *         @OA\Property(property="from", type="integer", example=1),
 *         @OA\Property(property="last_page", type="integer", example=1),
 *         @OA\Property(property="path", type="string", example="http://127.0.0.1:8000/api/v1/posts/10/comments"),
 *         @OA\Property(property="per_page", type="integer", example=25),
 *         @OA\Property(property="to", type="integer", example=1),
 *         @OA\Property(property="total", type="integer", example=1)
 *     )
 * )
 */

interface CommentPaginatedResourceInterface
{
}
