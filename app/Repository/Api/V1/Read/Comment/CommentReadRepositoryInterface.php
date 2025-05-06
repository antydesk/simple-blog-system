<?php

namespace App\Repository\Api\V1\Read\Comment;

use App\Models\Comment;
use Illuminate\Pagination\LengthAwarePaginator;

interface CommentReadRepositoryInterface
{
    public function getById(int $id, array $relations = []): Comment;

    public function paginate(int $userId,int $postId, int $perPage, int $page, ?string $q = null, array $relations = [],?int $parentId = null): LengthAwarePaginator;

}
