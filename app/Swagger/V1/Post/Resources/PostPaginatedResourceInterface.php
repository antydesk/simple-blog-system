<?php

namespace App\Swagger\V1\Post\Resources;

/**
 * @OA\Schema(
 *     schema="PostPaginatedResource",
 *     title="PostPaginatedResource",
 *     description="Пагинированный список постов",
 *     type="object",
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/PostResource")
 *     ),
 *     @OA\Property(
 *         property="links",
 *         type="object",
 *         @OA\Property(property="first", type="string", example="http://127.0.0.1:8000/api/v1/users/25/posts?page=1"),
 *         @OA\Property(property="last", type="string", example="http://127.0.0.1:8000/api/v1/users/25/posts?page=1"),
 *         @OA\Property(property="prev", type="string", nullable=true, example=null),
 *         @OA\Property(property="next", type="string", nullable=true, example=null)
 *     ),
 *     @OA\Property(
 *         property="meta",
 *         type="object",
 *         @OA\Property(property="current_page", type="integer", example=1),
 *         @OA\Property(property="from", type="integer", example=1),
 *         @OA\Property(property="last_page", type="integer", example=1),
 *         @OA\Property(property="path", type="string", example="http://127.0.0.1:8000/api/v1/users/25/posts"),
 *         @OA\Property(property="per_page", type="integer", example=25),
 *         @OA\Property(property="to", type="integer", example=1),
 *         @OA\Property(property="total", type="integer", example=1)
 *     )
 * )
 */
interface PostPaginatedResourceInterface
{
}

