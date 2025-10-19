<?php

namespace App\Http\Requests\Api\V1\Post;

use App\Http\Requests\Api\V1\ListRequest;

class PostListRequest extends ListRequest
{
    public const string USER_ID = 'user_id';

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
}
