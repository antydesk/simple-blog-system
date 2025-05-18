<?php

namespace App\Http\Requests\Api\V1\Comment;

use Illuminate\Foundation\Http\FormRequest;


class CommentCreateRequest extends FormRequest
{
    public const string CONTENT = 'content';
    public const string USER_ID = 'user_id';
    public const string POST_ID = 'post_id';
    public const string PARENT_ID = 'parent_id';

    public function rules(): array
    {
        return [
            self::CONTENT => ['required', 'string', 'min:5', 'max:1000'],
            self::PARENT_ID => ['nullable', 'integer', 'min:1'],
            self::POST_ID => ['required', 'integer', 'exists:posts,id'],
            self::USER_ID => ['required', 'integer', 'exists:users,id'],

        ];
    }

    public function validationData()
    {
        return array_merge($this->all(), [
            self::POST_ID => $this->route(self::POST_ID),
            self::USER_ID => $this->route(self::USER_ID),
        ]);
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
}
