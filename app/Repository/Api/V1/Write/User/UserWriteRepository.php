<?php

namespace App\Repository\Api\V1\Write\User;

use App\Dto\Api\V1\Auth\UserRegisterDto;
use App\Dto\Api\V1\User\UserUpdateDto;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserWriteRepository implements UserWriteRepositoryInterface
{

    public function query(): Builder
    {
        return User::query();
    }

    public function create(UserRegisterDto $userRegisterDto): User
    {
        return $this->query()->create([
            'name' => $userRegisterDto->name,
            'email' => $userRegisterDto->email,
            'password' => $userRegisterDto->password,
        ]);
    }


    public function update(UserUpdateDto $userUpdateDto): User
    {
        $this->query()->where('id', $userUpdateDto->id)->update([
            'name' => $userUpdateDto->name,
            'email' => $userUpdateDto->email,
        ]);

        return $this->query()->where('id', $userUpdateDto->id)->first();
    }

    public function destroy(int $user_id): bool
    {
        return $this->query()->where('id', $user_id)->delete();
    }
}
