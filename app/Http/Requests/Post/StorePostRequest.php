<?php

namespace App\Http\Requests\Post;

use Illuminate\Support\Facades\Auth;
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
            'post.title' => 'required|string',
            'post.content' => 'nullable|string',
            'post.image' => 'nullable|string',
            'post.video' => 'nullable|string',
            'post.profile_id' => 'required|integer|',
            'post.published_at' => 'nullable|date_format:Y-m-d',
            'post.category_id' => 'required|integer|',
            'post.views' => 'nullable|integer',
            'post.is_active' => 'required|boolean'
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            'post.profile_id' => Auth::user()->profile->id,
        ]);
    }
}
