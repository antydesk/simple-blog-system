<?php

namespace App\Services\Api\V1\Login;

use App\Dto\Api\V1\Login\UserLoginDto;
use App\Repository\Api\V1\Read\User\UserReadRepositoryInterface;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class UserLoginAction
{
    public function __construct(protected UserReadRepositoryInterface $userReadRepository)
    {
    }

    /**
     * @throws AuthenticationException
     */
    public function run(UserLoginDto $dto): array
    {
        if (!Auth::attempt([
            'email' => $dto->email,
            'password' => $dto->password,
        ])) {
            throw new AuthenticationException('Unauthorized');
        }

        $user = $this->userReadRepository->getByEmail($dto->email);

        $token = $user->createToken('AppToken')->accessToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

}
