<?php

namespace App\Services\Api\V1\User;

use App\Repository\Api\V1\Write\User\UserWriteRepositoryInterface;

class UserDestroyAction
{
    public function __construct(protected UserWriteRepositoryInterface $userWriteRepository) {}

    public function run(int $user_id): bool
    {
        return $this->userWriteRepository->destroy($user_id);
    }
}
