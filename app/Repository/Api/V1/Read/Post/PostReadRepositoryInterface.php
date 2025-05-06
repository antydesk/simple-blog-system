<?php

namespace App\Repository\Api\V1\Read\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface PostReadRepositoryInterface
{
    public function getById(int $id, array $relations = []): Post;

    public function getAll(int $user_id, array $relations = []): Collection;

    public function paginate(int $userId, int $perPage, int $page, ?string $q = null, array $relations = []): LengthAwarePaginator;

}
