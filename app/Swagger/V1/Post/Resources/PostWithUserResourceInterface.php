<?php

namespace App\Swagger\V1\Post\Resources;

/**
 * @OA\Schema(
 *     schema="PostWithUserResource",
 *     title="PostWithUserResource",
 *     description="Пост без связей",
 *     type="object",
 *
 *     @OA\Property(property="id", type="integer", example=6),
 *     @OA\Property(property="title", type="string", example="Обновлённый заголовок"),
 *     @OA\Property(property="content", type="string", example="Обновлённое содержимое поста."),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-05-09T09:16:11.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-05-09T11:24:08.000000Z"),
 *     @OA\Property(
 *         property="user",
 *         ref="#/components/schemas/UserResource"
 *     )
 * )
 */
interface PostWithUserResourceInterface {}
