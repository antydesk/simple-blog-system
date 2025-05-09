<?php

namespace App\Services\Api\V1\Auth\Actions;

use App\Dto\Api\V1\Auth\UserLoginDto;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Laravel\Passport\Exceptions\OAuthServerException;

class LoginAction extends ParentAuthAction
{
    /**
     * @throws AuthorizationException
     * @throws OAuthServerException
     * @throws AuthenticationException
     */
    public function run(UserLoginDto $dto): array
    {
        $this->init($dto);

        $this->createServerRequest();

        $this->getPassportCredentials();

        $this->withParsedBodyToServerRequest();

        $this->createAuthenticationToken();

        return $this->tokenData;
    }

    private function init(UserLoginDto $dto): void
    {
        $this->dto = $dto;
        $this->user = $this->userReadRepository->getByEmail($this->dto->email);
    }
}
