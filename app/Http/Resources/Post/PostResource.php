<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Tag\TagResource;
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
            'category_id' => $this->category_id,
            'category_title' => $this->category->title,
            'published_at' => $this->published_at,
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'is_active' => $this->is_active,
            'views' => $this->views,
            'image_urls' => $this->image_urls,
            'profile_id' => $this->profile_id,
            'tags' => implode(',', array_column(TagResource::collection($this->tags)->resolve(), 'title'))
        ];
    }
}
