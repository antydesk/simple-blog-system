<?php

namespace App\Swagger\V1\Like\LikeComment;

/**
 * @OA\Get(
 *     path="/api/v1/users/{user_id}/posts/{post_id}/comments/{comment_id}/likes",
 *     operationId="getCommentLikes",
 *     summary="Получить список лайков коммента",
 *     description="Возвращает список всех лайков, принадлежащих указанному комменту",
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
 *     @OA\Parameter (
 *          name="comment_id",
 *          in="path",
 *          description="ID коммента",
 *          required=true,
 *
 *          @OA\Schema (
 *              type="integer",
 *              example=10
 *          )
 *      ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Успешный ответ. Список лайков коммента.",
 *
 *         @OA\JsonContent(ref="#/components/schemas/CommentResource")
 *     )
 * )
 */
interface LikeCommentIndexInterface {}
