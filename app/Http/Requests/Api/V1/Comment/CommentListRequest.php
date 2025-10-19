<?php

namespace App\Http\Requests\Api\V1\Comment;

use App\Http\Requests\Api\V1\ListRequest;

class CommentListRequest extends ListRequest
{
    public const string USER_ID = 'user_id';

    public const string POST_ID = 'post_id';

    /**
     * Определяет правила валидации.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        ];
    }

    /**
     * Получить user_id.
     */
    public function getUserId(): int
    {
        return (int) $this->route(self::USER_ID);
    }

    /**
     * Получить user_id.
     */
    public function getPostId(): int
    {
        return (int) $this->route(self::POST_ID);
    }
}
