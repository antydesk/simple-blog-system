<?php

namespace App\Http\Resources\Api\V1\Like;

use App\Http\Resources\Api\V1\Comment\CommentResource;
use App\Http\Resources\Api\V1\Post\PostResource;
use App\Http\Resources\Api\V1\User\UserResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'user' => new UserResource($this->whenLoaded('user')),
            'likeable' => $this->whenLoaded('likeable', function () {
                // Можно сюда вложить другой ресурс в зависимости от типа
                if ($this->likeable_type === Post::class) {
                    return new PostResource($this->likeable);
                }

                if ($this->likeable_type === Comment::class) {
                    return new CommentResource($this->likeable);
                }

                return null;
            }),
            'created_at' => $this->resource->created_at->toDateTimeString(),
            'updated_at' => $this->resource->updated_at->toDateTimeString(),
        ];
    }
}
