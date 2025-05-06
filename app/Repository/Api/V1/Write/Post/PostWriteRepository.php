<?php

namespace App\Repository\Api\V1\Write\Post;

use App\Dto\Api\V1\Post\PostCreateDto;
use App\Dto\Api\V1\Post\PostUpdateDto;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;

class PostWriteRepository implements PostWriteRepositoryInterface
{

    protected function query(): Builder
    {
        return Post::query();
    }

    public function create(PostCreateDto $postCreateDto): Post
    {
        return $this->query()->create([
            'user_id' => $postCreateDto->user_id,
            'content' => $postCreateDto->content,
            'title' => $postCreateDto->title,
        ]);
    }

    public function update(PostUpdateDto $postUpdateDto): Post
    {
        $this->query()->where('id', $postUpdateDto->id)->update([
            'content' => $postUpdateDto->content,
            'title' => $postUpdateDto->title,
        ]);

        return $this->query()->where('id', $postUpdateDto->id)->first();
    }

    public function destroy(int $post_id): bool
    {
        return $this->query()->where('id', $post_id)->delete();
    }

}
