<?php

namespace App\Swagger\V1\Auth\Resources;

/**
 * @OA\Schema(
 *     schema="CredentialResource",
 *     type="object",
 *
 *     @OA\Property(property="access_token", type="string", example="eyJ0eXAiOiJKV1Qi..."),
 *     @OA\Property(property="refresh_token", type="string", example="d3c9a12b..."),
 *     @OA\Property(property="token_type", type="string", example="Bearer"),
 *     @OA\Property(property="expires_in", type="integer", example=3600)
 * )
 */
interface CredentialResourceInterface {}
