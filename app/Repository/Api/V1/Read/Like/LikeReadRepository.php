<?php

namespace App\Repository\Api\V1\Read\Like;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class LikeReadRepository implements LikeReadRepositoryInterface
{
    public function getByPostId(int $postId): Collection
    {
        return $this->query()
            ->where("likeable_id", $postId)
            ->where("likeable_type", Post::class)
            ->get();
    }

    public function getByCommentId(int $commentId): Collection
    {
        return $this->query()
            ->where("likeable_id", $commentId)
            ->where("likeable_type", Comment::class)
            ->get();
    }


    public function query(): Builder
    {
        return Like::query();
    }

}
