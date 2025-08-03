<?php

namespace App\Http\Resources\Api\V1\Comment;

use App\Http\Resources\Api\V1\Like\LikeResource;
use App\Http\Resources\Api\V1\Post\PostResource;
use App\Http\Resources\Api\V1\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
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
            'content' => $this->resource->content,
            'user' => new UserResource($this->whenLoaded('user')),
            'post' => new PostResource($this->whenLoaded('post')),
            'parent' => new CommentResource($this->whenLoaded('parent')),
            'children' => CommentResource::collection($this->whenLoaded('children')),
            'likes' => LikeResource::collection($this->whenLoaded('likes')),
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
