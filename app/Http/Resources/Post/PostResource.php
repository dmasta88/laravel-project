<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\Profile\ProfileResource;
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
            'date_formatted' => $this->date_formatted,
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'is_active' => $this->is_active,
            'parent_id' => $this->parent_id,
            //'parent' => $this->whenLoaded('parent', new PostResource($this->parent)),
            'parent' => $this->parent ? PostResource::make($this->parent)->resolve() : null,
            //'parent' => PostResource::make($this->parent)->resolve() ?? null,
            //'parent' => $this->whenLoaded('parent', fn() => (new PostResource($this->parent))->toArray($request)),
            'views' => $this->views,
            'image_urls' => $this->image_urls,
            'profile_id' => $this->profile_id,
            'profile' => ProfileResource::make($this->profile)->resolve(),
            'tags' => implode(',', array_column(TagResource::collection($this->tags)->resolve(), 'title')),
            'is_liked' => $this->is_liked,
            'liked_count' => $this->who_liked_count,
            'comments_count' => $this->comments_count
        ];
    }
}
