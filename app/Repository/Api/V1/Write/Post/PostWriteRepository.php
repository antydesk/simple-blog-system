<?php

namespace App\Repository\Api\V1\Write\Post;

use App\Dto\Api\V1\Post\PostCreateDto;
use App\Dto\Api\V1\Post\PostUpdateDto;
use App\Models\Post;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostWriteRepository implements PostWriteRepositoryInterface
{
    /**
     * @return Builder<Post>
     */
    protected function query(): Builder
    {
        return Post::query();
    }

    /**
     * @param PostCreateDto $postCreateDto
     * @return Post
     */
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
     * @throws NotFoundHttpException
     */
    public function update(PostUpdateDto $postUpdateDto): Post
    {
        /** @var Post|null $post */
        $post = $this->query()->where('id', $postUpdateDto->id)->first();

        if (!$post) {
            throw new NotFoundHttpException('Post not found.');
        }

        if (!Gate::allows('update', $post)) {
            throw new AuthorizationException('You are not allowed to update this post.');
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
            throw new NotFoundHttpException('Post not found.');
        }

        if (!Gate::allows('delete', $post)) {
            throw new AuthorizationException('You are not allowed to delete this post.');
        }

        return $post->delete();
    }
}
