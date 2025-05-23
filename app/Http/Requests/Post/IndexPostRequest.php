<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class IndexPostRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => "nullable|string",
            "published_at_from" => "nullable|date_format:Y-m-d",
            "category_id" => "nullable|integer|exists:categories,id",
            "category_title" => "nullable|string",
            'content' => 'nullable|string',
            'profile_id' => 'nullable|integer|exists:profiles,id',
            'views_from' => 'nullable|integer',
            'is_active' => 'nullable|boolean'
        ];
    }
}
