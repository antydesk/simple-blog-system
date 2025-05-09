<?php

namespace App\Swagger\V1\Auth;


/**
 * @OA\Post(
 *     path="/auth/logout",
 *     summary="Выход пользователя",
 *     tags={"Auth"},
 *     security={{"bearerAuth":{}}},
 *     @OA\Response(
 *         response=204,
 *         description="Успешный выход (без контента)"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Неавторизован"
 *     )
 * )
 */
interface UserLogoutInterface
{
}
