<?php

namespace App\Http\Resources\Message;

use Illuminate\Http\Request;
use App\Http\Resources\Profile\ProfileResource;
use Illuminate\Http\Resources\Json\JsonResource;

class BroadcastMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "content" => $this->content,
            "profile_id" => $this->profile_id,
            "profile" => ProfileResource::make($this->profile)->resolve(),
            "chat_id" => $this->chat_id,
            "published_at" => $this->human_date,
        ];
    }
}
