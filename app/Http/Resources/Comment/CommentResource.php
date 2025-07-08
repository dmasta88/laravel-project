<?php

namespace App\Http\Resources\Comment;

use App\Http\Resources\Profile\ProfileResource;
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
            'id' => $this->id,
            'profile' => ProfileResource::make($this->profile)->resolve(),
            'post_id' => $this->commentable->id,
            'content' => $this->content,
            'formatted_date' => $this->formatted_date,
            'published_at' => $this->published_at,
            'category_title' => $this->category_title,
            'parent_id' => $this->parent_id,
            'children' => CommentResource::collection($this->children)->resolve(),
            'is_liked' => $this->is_liked,
            'liked_count' => $this->who_liked_count
        ];
    }
}
