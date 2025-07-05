<?php

namespace App\Http\Requests\Api\V1\Like;

use Illuminate\Foundation\Http\FormRequest;

class LikeIndexRequest extends FormRequest
{
    public const string USER_ID = 'user_id';
    public const string POST_ID = 'post_id';

    public function rules(): array
    {
        return [
            //
        ];
    }

    public function getUserId(): int
    {
        return (int)$this->route(self::USER_ID);
    }

    public function getPostId(): int
    {
        return (int)$this->route(self::POST_ID);
    }
}
