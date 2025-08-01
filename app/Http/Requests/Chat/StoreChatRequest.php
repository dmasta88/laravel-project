<?php

namespace App\Http\Requests\Chat;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreChatRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //"title" => "required|string|unique:chats,title",
            "title" => "required|string",
            "creator_id" => "required|integer",
            "profile_id" => "required|array",
            "profile_id.*" => "required|integer|exists:profiles,id"
        ];
    }
    public function prepareForValidation()
    {
        $creator = Auth::user()->profile;
        $profiles = implode(',', $this->profile_id);
        return $this->merge([
            'creator_id' => $creator->id,
            'title' => 'Chat ' . $creator->login . ' with ' . $profiles,
        ]);
    }
}
