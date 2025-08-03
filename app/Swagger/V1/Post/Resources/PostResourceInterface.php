<?php

namespace App\Swagger\V1\Post\Resources;

/**
 * @OA\Schema(
 *     schema="PostResource",
 *     title="PostResource",
 *     description="Ресурс поста",
 *     type="object",
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="title",
 *         type="string",
 *         example="Название поста"
 *     ),
 *     @OA\Property(
 *         property="content",
 *         type="string",
 *         example="Текст поста"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         example="2025-05-04T12:34:56Z"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         example="2025-05-04T12:34:56Z"
 *     ),
 *     @OA\Property(
 *         property="user",
 *         ref="#/components/schemas/UserResource"
 *     ),
 *     @OA\Property(
 *         property="comments",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/CommentResource")
 *     ),
 *     @OA\Property(
 *         property="likes",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/LikePostResource")
 *     )
 * )
 */
interface PostResourceInterface
{
}
