<?php

namespace App\Swagger\V1\Auth;

/**
 * @OA\Post(
 *     path="/auth/login",
 *     summary="Вход пользователя",
 *     tags={"Auth"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"email", "password"},
 *             @OA\Property(property="email", type="string", format="email", example="ivan@example.com"),
 *             @OA\Property(property="password", type="string", format="password", example="secret123"),
 *             @OA\Property(property="remember", type="boolean", example=true)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Успешная авторизация",
 *         @OA\JsonContent(
 *              type="object",
 *              @OA\Property(
 *                  property="data",
 *                  ref="#/components/schemas/CredentialResource"
 *              )
 *          )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Неверные учетные данные"
 *     )
 * )
 */
interface UserLoginInterface
{
}
