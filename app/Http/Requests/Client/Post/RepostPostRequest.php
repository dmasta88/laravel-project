<?php

namespace App\Http\Requests\Client\Post;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class RepostPostRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post.title' => 'required|string',
            'post.content' => 'nullable|string',
            'post.profile_id' => 'required|integer|',
            'post.published_at' => 'nullable|date_format:Y-m-d',
            'post.category_id' => 'required|integer|',
            'post.views' => 'nullable|integer',
            'post.is_active' => 'required|boolean',
            'post.parent_id' => 'required|integer|exists:posts,id'
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'post.profile_id' => Auth::user()->profile->id,
            'post.published_at' => now()->format('Y-m-d')
        ]);
    }
}
