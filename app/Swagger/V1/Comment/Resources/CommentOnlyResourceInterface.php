<?php

namespace App\Swagger\V1\Comment\Resources;

/**
 * @OA\Schema(
 *     schema="CommentOnlyResource",
 *     title="CommentResource",
 *     description="Ресурс комментария",
 *     type="object",
 *
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example=101
 *     ),
 *     @OA\Property(
 *         property="content",
 *         type="string",
 *         example="Это комментарий к посту"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         example="2025-05-04T14:00:00Z"
 *     )
 * )
 */
interface CommentOnlyResourceInterface {}
