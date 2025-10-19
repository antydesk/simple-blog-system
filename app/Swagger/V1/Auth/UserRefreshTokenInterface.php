<?php

namespace App\Swagger\V1\Auth;

/**
 * @OA\Post(
 *     path="/auth/refresh-token",
 *     summary="Обновление access токена",
 *     tags={"Auth"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"refresh_token"},
 *
 *             @OA\Property(property="refresh_token", type="string", example="your-refresh-token")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Обновленный токен",
 *
 *        @OA\JsonContent(
 *                type="object",
 *
 *                @OA\Property(
 *                 property="data",
 *                 ref="#/components/schemas/CredentialResource"
 *                )
 *        )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Неверный refresh token"
 *     )
 * )
 */
interface UserRefreshTokenInterface {}
