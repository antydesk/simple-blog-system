<?php

namespace App\Http\Requests\Api\V1\Like;

use Illuminate\Foundation\Http\FormRequest;

class LikeCommentIndexRequest extends LikeIndexRequest
{
    public const string COMMENT_ID = 'comment_id';

    public function rules(): array
    {
        return [
            //
        ];
    }

    public function getCommentId(): int
    {
        return (int)$this->route(self::COMMENT_ID);
    }

}
