<?php

namespace App\Http\Requests\Comment;

use Illuminate\Foundation\Http\FormRequest;

class IndexCommentRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'profile_id' => 'nullable|integer|exists:profiles,id',
            'post_id' => 'nullable|integer|exists:posts,id',
            'content' => 'nullable|string',
            'published_at_from' => 'nullable|date_format:Y-m-d',
            'category_title' => 'nullable|string|exists:categories,title'
        ];
    }
}
