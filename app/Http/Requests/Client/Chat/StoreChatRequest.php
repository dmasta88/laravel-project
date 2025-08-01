<?php

namespace App\Http\Requests\Client\Chat;

use App\Models\Profile;
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
            "profile_ids" => "required|array",
            "profile_ids.*" => "required|integer|exists:profiles,id"
        ];
    }
    public function prepareForValidation()
    {
        $creator = Auth::user()->profile;
        $logins = Profile::whereIn('id', $this->profile_ids)->get()->pluck('login')->implode(', ');
        $prifileIds = $this->profile_ids;
        $prifileIds[] = $creator->id;

        return $this->merge([
            'creator_id' => $creator->id,
            'title' => 'Chat with ' . $logins,
            'profile_ids' => $prifileIds
        ]);
    }
}
