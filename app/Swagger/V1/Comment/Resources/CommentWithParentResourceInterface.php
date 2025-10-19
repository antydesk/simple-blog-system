<?php

namespace App\Swagger\V1\Comment\Resources;

/**
 * @OA\Schema(
 *     schema="CommentWithParentResource",
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
 *         property="user",
 *         ref="#/components/schemas/UserResource"
 *     ),
 *     @OA\Property(
 *         property="post",
 *         ref="#/components/schemas/PostOnlyResource"
 *     ),
 *     @OA\Property(
 *         property="parent",
 *         ref="#/components/schemas/CommentOnlyResource"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         example="2025-05-04T14:00:00Z"
 *     )
 * )
 */
interface CommentWithParentResourceInterface {}
