<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'second_name' => $this->second_name,
            'third_name' => $this->third_name,
            'avatar' => $this->avatar,
            'city' => $this->city,
            'login' => $this->login,
            'is_followed' => $this->is_followed
        ];
    }
}
