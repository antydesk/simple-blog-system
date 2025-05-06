<?php

namespace App\Services\Api\V1\Register;

use App\Dto\Api\V1\Register\UserRegisterDto;
use App\Repository\Api\V1\Write\User\UserWriteRepositoryInterface;
use Illuminate\Support\Facades\Http;

class UserRegisterAction
{
    public function __construct(protected UserWriteRepositoryInterface $userWriteRepository)
    {
    }

    public function run(UserRegisterDto $dto): array
    {
        $user = $this->userWriteRepository->create($dto);

        $token = $user->createToken('AppToken')->accessToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

}
