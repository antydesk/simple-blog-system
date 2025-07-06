<?php

namespace App\Repository\Api\V1\Write\Like;

use App\Dto\Api\V1\Like\CreateLikeCommentDto;
use App\Dto\Api\V1\Like\CreateLikeDto;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class LikeWriteRepository implements LikeWriteRepositoryInterface
{

    public function createByPost(CreateLikeDto $data): Like
    {
        return $this->query()->create([
            'user_id' => $data->user_id,
            'likeable_id' => $data->post_id,
            'likeable_type' => Post::class
        ]);
    }

    public function createByComment(CreateLikeCommentDto $data): Like
    {
        return $this->query()->create([
            'user_id' => $data->user_id,
            'likeable_id' => $data->comment_id,
            'likeable_type' => Comment::class
        ]);
    }

    private function query(): Builder
    {
        return Like::query();
    }


}
