<?php

namespace App\Repository\Api\V1\Write\Comment;

use App\Dto\Api\V1\Comment\CommentCreateDto;
use App\Dto\Api\V1\Comment\CommentUpdateDto;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Builder;

class CommentWriteRepository implements CommentWriteRepositoryInterface
{
    /**
     * @param CommentCreateDto $commentCreateDto
     * @return Comment
     */
    public function create(CommentCreateDto $commentCreateDto): Comment
    {
        return $this->query()->create([
            'content' => $commentCreateDto->content,
            'user_id' => $commentCreateDto->user_id,
            'post_id' => $commentCreateDto->post_id,
            'parent_id' => $commentCreateDto->parent_id,
        ]);
    }

    public function update(CommentUpdateDto $commentUpdateDto): Comment
    {
        /** @var Comment $comment */
        $comment = $this->query()->findOrFail($commentUpdateDto->id);

        $comment->update([
            'content' => $commentUpdateDto->content,
            'user_id' => $commentUpdateDto->user_id,
            'post_id' => $commentUpdateDto->post_id,
            'parent_id' => $commentUpdateDto->parent_id,
        ]);

        return $comment;
    }

    public function destroy(int $comment_id): bool
    {
        $comment = $this->query()->findOrFail($comment_id);
        return $comment->delete();
    }

    /**
     * @return Builder<Comment>
     */
    protected function query(): Builder
    {
        return Comment::query();
    }
}
