<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Facades\Storage;
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
            'title' => 'required|string',
            'content' => 'required|string',
            'images' => 'nullable|array',
            'video' => 'nullable|string',
            'profile_id' => 'required|integer|exists:profiles,id',
            'published_at' => 'nullable|date_format:Y-m-d',
            'category_id' => 'required|integer|exists:categories,id',
            'views' => 'nullable|integer',
            'is_active' => 'required|boolean',
            'image_path' => 'nullable|string'
        ];
    }
    protected function prepareForValidation()
    {
        $this->merge([
            //'image_path' => Storage::disk('public')->put('images', $this->images),
            'profile_id' => auth()->user()->id
        ]);
    }
}
