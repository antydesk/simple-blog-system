<?php

namespace App\Swagger\V1\Auth;

/**
 * @OA\Post(
 *     path="/api/v1/register",
 *     summary="Регистрация нового пользователя",
 *     description="Создание нового аккаунта пользователя.",
 *     tags={"Auth"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"email", "password", "name"},
 *             @OA\Property(property="name", type="string", example="Иван Иванов"),
 *             @OA\Property(property="email", type="string", format="email", example="ivan@example.com"),
 *             @OA\Property(property="password", type="string", format="password", example="secret123"),
 *             @OA\Property(property="password_confirmation", type="string", format="password", example="secret123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Успешная регистрация",
 *         @OA\JsonContent(
 *             @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1Qi..."),
 *             @OA\Property(
 *                 property="user",
 *                 type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="name", type="string", example="Иван Иванов"),
 *                 @OA\Property(property="email", type="string", example="ivan@example.com")
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Ошибка валидации",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="The email has already been taken."),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(property="email", type="array", @OA\Items(type="string", example="Поле email обязательно."))
 *             )
 *         )
 *     ),
 *
 * )
 */
interface UserRegisterInteface
{
}
