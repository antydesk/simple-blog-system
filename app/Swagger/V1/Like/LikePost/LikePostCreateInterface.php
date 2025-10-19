<?php

namespace App\Swagger\V1\Like\LikePost;

/**
 * @OA\Post(
 *     path="/api/v1/users/{user_id}/posts/{post_id}/likes",
 *     operationId="createPostLike",
 *     summary="Создание лайка поста",
 *     description="Позволяет поставить лайк указанному посту от имени авторизованного пользователя",
 *     tags={"Like"},
 *     security={{"bearerAuth": {}}},
 *
 *     @OA\Parameter (
 *         name="user_id",
 *         in="path",
 *         description="ID пользователя, которому принадлежит пост",
 *         required=true,
 *
 *         @OA\Schema (
 *             type="integer",
 *             example=1
 *         )
 *     ),
 *
 *     @OA\Parameter (
 *         name="post_id",
 *         in="path",
 *         description="ID поста",
 *         required=true,
 *
 *         @OA\Schema (
 *             type="integer",
 *             example=42
 *         )
 *     ),
 *
 *     @OA\Response(
 *          response=201,
 *          description="Лайк успешно создан",
 *
 *          @OA\JsonContent(ref="#/components/schemas/LikePostResource")
 *     )
 * )
 */
interface LikePostCreateInterface {}
