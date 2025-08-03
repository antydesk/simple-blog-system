<?php

namespace App\Swagger\V1\Like\LikePostResource;

/**
 * @OA\Schema (
 *     schema="LikePostResource",
 *     title="LikePostResource",
 *     description="Ресурс Лайка для постов",
 *     type="object",
 *     @OA\Property (
 *         property="id",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property (
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         example="2025-05-04T12:34:56Z"
 *     ),
 *     @OA\Property (
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         example="2025-05-04T12:34:56Z"
 *     ),
 *     @OA\Property (
 *         property="user",
 *         ref="#/components/schemas/UserResource"
 *     ),
 *     @OA\Property (
 *         property="likeable",
 *         ref="#/components/schemas/PostOnlyResource"
 *     )
 * )
 */
interface LikePostResourceInterface
{
}
