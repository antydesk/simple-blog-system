<?php

namespace App\Repository\Api\V1\Write\User;

use App\Dto\Api\V1\Auth\UserRegisterDto;
use App\Dto\Api\V1\User\UserUpdateDto;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class UserWriteRepository implements UserWriteRepositoryInterface
{
    /**
     * @return Builder<User>
     */
    public function query(): Builder
    {
        return User::query();
    }

    /**
     * @param UserRegisterDto $userRegisterDto
     * @return User
     */
    public function create(UserRegisterDto $userRegisterDto): User
    {
        return $this->query()->create([
            'name' => $userRegisterDto->name,
            'email' => $userRegisterDto->email,
            'password' => $userRegisterDto->password,
        ]);
    }

    /**
     * @param UserUpdateDto $userUpdateDto
     * @return User
     */
    public function update(UserUpdateDto $userUpdateDto): User
    {
        /** @var User $user */
        $user = $this->query()->findOrFail($userUpdateDto->id);

        $user->update([
            'name' => $userUpdateDto->name,
            'email' => $userUpdateDto->email,
        ]);

        return $user;
    }

    public function destroy(int $user_id): bool
    {
        return $this->query()->where('id', $user_id)->delete();
    }
}
