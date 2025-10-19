<?php

namespace App\Services\Api\V1\Auth\Actions;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Laravel\Passport\Exceptions\OAuthServerException;

class RefreshTokenAction extends ParentAuthAction
{
    /**
     * @throws AuthorizationException
     * @throws AuthenticationException
     * @throws OAuthServerException
     */
    public function run(string $refreshToken): array
    {
        $this->createServerRequest();

        $this->getPassportCredentials();

        $this->withParsedBodyToServerRequestForRefreshToken($refreshToken);

        $this->createAuthenticationToken();

        return $this->tokenData;
    }
}
