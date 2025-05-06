<?php

namespace App\Repository\Api\V1\Read\Post;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class PostReadRepository implements PostReadRepositoryInterface
{

    public function getById(int $id, array $relations = []): Post
    {
        $post = $this->query()
            ->where('id', $id)
            ->with($relations)
            ->first();

        if (is_null($post)) {
            throw new ModelNotFoundException(); // TODO create PostNotFoundException
        }

        return $post;
    }

    public function getAll(int $user_id, array $relations = []): Collection
    {
        return $this->query()
            ->where('user_id', $user_id)
            ->with($relations)
            ->get();
    }

    public function query(): Builder
    {
        return Post::query();
    }

    public function paginate(
        int $userId,
        int $perPage,
        int $page,
        ?string $q = null,
        array $relations = []
    ): LengthAwarePaginator {
        $query = $this->query()
            ->where('user_id', $userId)
            ->with($relations);

        if ($q) {
            $query->where(function ($qBuilder) use ($q) {
                $qBuilder->where('title', 'ILIKE', "%$q%")
                    ->orWhere('content', 'ILIKE', "%$q%");
            });
        }

        return $query->orderByDesc('created_at')
            ->paginate(perPage: $perPage, page: $page);
    }


}
