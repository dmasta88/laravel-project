<?php

namespace App\Http\Requests\Client\Comment;

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
            'page' => 'nullable|integer',
            'per_page' => 'nullable|integer',
        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            'page' => $this->page ?? 1,
            'per_page' => $this->per_page ?? 5
        ]);
        return '';
    }
}
