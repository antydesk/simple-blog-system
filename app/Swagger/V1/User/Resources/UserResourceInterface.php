<?php

namespace App\Swagger\V1\User\Resources;

/**
 * @OA\Schema(
 *     schema="UserResource",
 *     title="UserResource",
 *     description="Ресурс пользователя",
 *     type="object",
 *
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         example="Иван Иванов"
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         example="ivan@example.com"
 *     )
 * )
 */
interface UserResourceInterface {}
