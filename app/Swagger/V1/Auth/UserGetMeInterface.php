<?php

namespace App\Swagger\V1\Auth;

/**
 * @OA\Get(
 *     path="/auth/me",
 *     summary="Получить текущего авторизованного пользователя",
 *     tags={"Auth"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Информация о пользователе",
 *
 *         @OA\JsonContent(
 *              type="object",
 *
 *              @OA\Property(
 *               property="data",
 *               ref="#/components/schemas/UserResource"
 *              )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Неавторизован"
 *     )
 * )
 */
interface UserGetMeInterface {}
