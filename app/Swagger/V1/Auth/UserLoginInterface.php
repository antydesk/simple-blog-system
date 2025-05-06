<?php

namespace App\Swagger\V1\Auth;

/**
 * @OA\Post(
 *     path="/api/v1/login",
 *     summary="Вход пользователя",
 *     description="Аутентификация пользователя по email и паролю. В случае успешного входа возвращается access token.",
 *     tags={"Auth"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"email", "password"},
 *             @OA\Property(property="email", type="string", format="email", example="ivan@example.com"),
 *             @OA\Property(property="password", type="string", format="password", example="secret123"),
 *             @OA\Property(property="password_confirmation", type="string", format="password", example="secret123")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Успешный вход",
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
 *             @OA\Property(property="message", type="string", example="Переданы неверные данные."),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(property="email", type="array", @OA\Items(type="string", example="Поле email обязательно.")),
 *                 @OA\Property(property="password", type="array", @OA\Items(type="string", example="Поле password обязательно."))
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Неверные учетные данные",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Неверный email или пароль.")
 *         )
 *     )
 * )
 */
interface UserLoginInterface
{
}
