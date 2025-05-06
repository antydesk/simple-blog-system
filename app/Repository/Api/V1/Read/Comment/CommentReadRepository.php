<?php

namespace App\Repository\Api\V1\Read\Comment;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class CommentReadRepository implements CommentReadRepositoryInterface
{

    public function getById(int $id, array $relations = []): Comment
    {
        $comment = $this->query()
            ->where('id', $id)
            ->with($relations)
            ->first();

        if (is_null($comment)) {
            throw new ModelNotFoundException(); // TODO create PostNotFoundException
        }

        return $comment;
    }

    public function query(): Builder
    {
        return Comment::query();
    }

    public function paginate(
        int $userId,
        int $postId,
        int $perPage,
        int $page,
        ?string $q = null,
        array $relations = [],
        ?int $parentId = null
    ): LengthAwarePaginator {
        $query = $this->query()
            ->where('user_id', $userId)
            ->where('post_id', $postId)
            ->with($relations);

        if (!is_null($parentId)) {
            $query->where('parent_id', $parentId);
        }

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
