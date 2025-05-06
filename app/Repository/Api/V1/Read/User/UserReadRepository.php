<?php

namespace App\Repository\Api\V1\Read\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserReadRepository implements UserReadRepositoryInterface
{

    public function getById(int $id, array $relations = []): User
    {
        $user = User::query()
            ->where('id', $id)
            ->with($relations)
            ->first();

        if (is_null($user)) {
            throw new ModelNotFoundException(); // TODO create UserNotFoundException
        }

        return $user;
    }

    public function query(): Builder
    {
        return User::query();
    }

    public function getByEmail(string $email, array $relations = []): User
    {
        $user = User::query()
            ->where('email', $email)
            ->with($relations)
            ->first();

        if (is_null($user)) {
            throw new ModelNotFoundException();  // TODO create UserNotFoundException
        }

        return $user;
    }
}
