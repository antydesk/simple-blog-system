<?php

namespace App\Repository\Api\V1\Write\User;


use App\Dto\Api\V1\Auth\UserRegisterDto;
use App\Dto\Api\V1\User\UserUpdateDto;
use App\Models\User;

interface UserWriteRepositoryInterface
{

    public function create(UserRegisterDto $userRegisterDto): User;

    public function update(UserUpdateDto $userUpdateDto): User;

    public function destroy(int $user_id): bool;

}
