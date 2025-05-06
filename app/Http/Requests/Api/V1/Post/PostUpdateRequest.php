<?php

namespace App\Http\Requests\Api\V1\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostUpdateRequest extends FormRequest
{
    public const string TITLE = 'title';
    public const string CONTENT = 'content';
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
            self::TITLE => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            self::CONTENT => [
                'required',
                'string',
                'min:5',
            ],
        ];
    }

    /**
     * Получить название поста.
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->get(self::TITLE);
    }

    /**
     * Получить содержимое поста.
     *
     * @param bool $asResource
     * @return string
     */
    public function getContent(bool $asResource = false): string
    {
        return $this->get(self::CONTENT);
    }

    /**
     * Получить user_id.
     *
     * @return int
     */
    public function getUserId(): int
    {
        return (int) $this->route(self::USER_ID);
    }

    /**
     * Получить user_id.
     *
     * @return int
     */
    public function getPostId(): int
    {
        return (int) $this->route(self::POST_ID);
    }
}
