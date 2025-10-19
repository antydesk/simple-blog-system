<?php

namespace App\Swagger\V1;

/**
 * @OA\Info(
 *     title="Документация API",
 *     version="1.0.0",
 *     description="Автогенерация API документации через L5 Swagger"
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Основной сервер"
 * )
 *
 * @OA\Compontents(
 *
 *    @OA\SecurityScheme(
 *     securityScheme="bearerAuth",
 *     type="http",
 *     scheme="bearer",
 *     description="Passport авторизация. Пример использования: `Authorization: Bearer {token}`. Используется для аутентификации через Laravel Passport.",
 *     bearerFormat="JWT"
 *  )
 * )
 */
interface OpenApi {}
