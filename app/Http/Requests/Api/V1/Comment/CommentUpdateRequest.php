<?php

namespace App\Http\Requests\Api\V1\Comment;

use Illuminate\Foundation\Http\FormRequest;

class CommentUpdateRequest extends FormRequest
{
    public const string CONTENT = 'content';
    public const string USER_ID = 'user_id';
    public const string POST_ID = 'post_id';
    public const string PARENT_ID = 'parent_id';
    public const string ID = 'comment_id';

    public function rules(): array
    {
        return [
            self::CONTENT => ['required', 'string', 'min:5', 'max:1000'],
        ];
    }

    public function getContent(bool $asResource = false): string
    {
        return $this->get(self::CONTENT);
    }

    public function getUserId(): int
    {
        return (int)$this->route(self::USER_ID);
    }

    public function getPostId(): ?int
    {
        return $this->route(self::POST_ID);
    }

    public function getParentId(): ?int
    {
        return $this->get(self::PARENT_ID);
    }

    public function getCommentId(): int
    {
        return (int)$this->route(self::ID);
    }
}
