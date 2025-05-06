<?php

namespace App\Http\Resources\Api\V1\Post;

use App\Http\Resources\Api\V1\Comment\CommentResource;
use App\Http\Resources\Api\V1\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            "id" => $this->resource->id,
            "content" => $this->resource->content,
            "title" => $this->resource->title,
            "updated_at" => $this->resource->updated_at,
            "created_at" => $this->resource->created_at,
            'user' => new UserResource($this->whenLoaded('user')),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
        ];
    }
}
