<?php

namespace App\Services\Api\V1\Auth\Actions;


use App\Http\Resources\Api\V1\User\UserResource;
use App\Repository\Api\V1\Read\User\UserReadRepositoryInterface;

class MeAction
{
    public function __construct(
        protected UserReadRepositoryInterface $userReadRepository,
    ) {
    }

    public function run(int $user_id): UserResource
    {
        $user = $this->userReadRepository->getById($user_id);


        return new UserResource($user);
    }
}
