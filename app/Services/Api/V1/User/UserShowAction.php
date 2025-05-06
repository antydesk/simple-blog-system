<?php

namespace App\Services\Api\V1\User;

use App\Models\User;
use App\Repository\Api\V1\Read\User\UserReadRepositoryInterface;

class UserShowAction
{
    public function __construct(protected UserReadRepositoryInterface $userReadRepository)
    {
    }

    public function run(string $user_id): User
    {
        return $this->userReadRepository->getById($user_id);
    }

}
