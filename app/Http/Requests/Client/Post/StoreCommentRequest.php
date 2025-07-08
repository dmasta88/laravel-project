<?php

namespace App\Http\Requests\Client\Post;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'required|string',
            'profile_id' => 'required|integer|exists:profiles,id',
            'published_at' => 'required|date_format:Y-m-d',
            'parent_id' => 'nullable|integer|exists:comments,id',
        ];
    }
    public function prepareForValidation()
    {
        $this->merge(
            [
                'profile_id' => Auth::user()->profile->id,
                'published_at' => now()->format('Y-m-d')
            ]
        );
    }
    public function messages(): array
    {
        return [
            'content.required' => 'This field id required',
        ];
    }
}
