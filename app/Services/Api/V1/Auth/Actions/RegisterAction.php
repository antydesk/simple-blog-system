<?php

namespace App\Services\Api\V1\Auth\Actions;

use App\Dto\Api\V1\Auth\UserLoginDto;
use App\Dto\Api\V1\Auth\UserRegisterDto;
use App\Repository\Api\V1\Read\User\UserReadRepositoryInterface;
use App\Repository\Api\V1\Write\User\UserWriteRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Laravel\Passport\Exceptions\OAuthServerException;

class RegisterAction
{
    public function __construct(
        protected UserReadRepositoryInterface $userReadRepository,
        protected UserWriteRepositoryInterface $userWriteRepository,
        protected LoginAction $loginAction,
    ) {}

    /**
     * @throws AuthorizationException
     * @throws AuthenticationException
     * @throws OAuthServerException
     */
    public function run(UserRegisterDto $dto): array
    {
        $this->userWriteRepository->create($dto);

        $userLoginDto = new UserLoginDto;

        $userLoginDto->email = $dto->email;
        $userLoginDto->password = $dto->password;

        return $this->loginAction->run($userLoginDto);
    }
}
