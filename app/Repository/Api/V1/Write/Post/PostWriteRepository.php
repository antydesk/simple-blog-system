<?php

namespace App\Repository\Api\V1\Write\Post;

use App\Dto\Api\V1\Post\PostCreateDto;
use App\Dto\Api\V1\Post\PostUpdateDto;
use App\Models\Post;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


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

    /**
     * @throws AuthorizationException
     */
    public function update(PostUpdateDto $postUpdateDto): Post
    {

        $post = $this->query()->where('id', $postUpdateDto->id)->first();

        if (!Gate::allows('update', $post)) {
            throw new AuthorizationException('You are not allowed to delete this post.');
        }

        if(!$post){
            throw new NotFoundHttpException('Post not found.');
        }

        $post->update([
            'content' => $postUpdateDto->content,
            'title' => $postUpdateDto->title,
        ]);

        return $post;
    }

    /**
     * @throws Exception
     */
    public function destroy(int $post_id): bool
    {
        $post = $this->query()->where('id', $post_id)->first();

        if (!$post) {
            throw new NotFoundHttpException('Post not found');
        }

        if (!Gate::allows('delete', $post)) {
            throw new AuthorizationException('You are not allowed to delete this post.');
        }

        return $post->delete();
    }

}
