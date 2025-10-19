<?php

namespace App\Services\Api\V1\User;

use App\Dto\Api\V1\User\UserUpdateDto;
use App\Models\User;
use App\Repository\Api\V1\Write\User\UserWriteRepositoryInterface;

class UserUpdateAction
{
    public function __construct(protected UserWriteRepositoryInterface $userWriteRepository) {}

    public function run(UserUpdateDto $dto): User
    {
        return $this->userWriteRepository->update($dto);
    }
}
