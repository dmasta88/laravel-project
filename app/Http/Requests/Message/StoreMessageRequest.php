<?php

namespace App\Http\Requests\Message;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "content" => "required|string",
            "profile_id" => "required|integer|exists:profiles,id",
            'published_at' => 'required|date_format:Y-m-d H:i:s',
        ];
    }
    public function prepareForValidation()
    {
        return $this->merge([
            'published_at' => now()->format('Y-m-d H:i:s'),
            'profile_id' => Auth::user()->profile->id
        ]);
    }
}
