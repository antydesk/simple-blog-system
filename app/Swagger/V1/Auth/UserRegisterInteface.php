<?php

namespace App\Swagger\V1\Auth;

/**
 * @OA\Post(
 *     path="/auth/register",
 *     summary="Регистрация нового пользователя",
 *     tags={"Auth"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"name", "email", "password"},
 *
 *             @OA\Property(property="name", type="string", example="Иван Иванов"),
 *             @OA\Property(property="email", type="string", format="email", example="ivan@example.com"),
 *             @OA\Property(property="password", type="string", format="password", example="secret123")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Пользователь успешно зарегистрирован",
 *
 *         @OA\JsonContent(
 *               type="object",
 *
 *               @OA\Property(
 *                property="data",
 *                ref="#/components/schemas/CredentialResource"
 *               )
 *          )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Ошибка валидации"
 *     )
 * )
 */
interface UserRegisterInteface {}
