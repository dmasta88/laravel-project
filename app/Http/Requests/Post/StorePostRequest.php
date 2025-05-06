<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|unique:posts,title',
            'content' => 'nullable|string',
            'image' => 'nullable|string',
            'video' => 'nullable|string',
            'profile_id' => 'required|integer|',
            'published_at' => 'nullable|date_format:Y-m-d',
            'category_id' => 'required|integer|',
            'views' => 'nullable|integer',
            'is_active' => 'required|boolean'
        ];
    }
}
