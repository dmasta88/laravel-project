<?php

namespace App\Http\Resources\Repost;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RepostResource extends JsonResource
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
            'user_id' => $this->user_id,
            'post_id' => $this->post_id
        ];
    }
}
