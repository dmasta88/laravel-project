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
            'post.title' => 'required|string',
            'post.content' => 'required|string',
            'post.images' => 'nullable|array',
            'post.video' => 'nullable|string',
            'post.profile_id' => 'required|integer|exists:profiles,id',
            'post.published_at' => 'nullable|date_format:Y-m-d\TH:i',
            'post.category_id' => 'required|integer|exists:categories,id',
            'post.views' => 'nullable|integer',
            'post.is_active' => 'required|boolean',
            'post.image_paths' => 'nullable|array',
            'tags' => 'nullable|array'
        ];
    }
    protected function prepareForValidation()
    {
        $image_paths = [];
        if ($this->images) {
            foreach ($this->images as $image) {
                $path = Storage::disk('public')->put('images', $image);
                $image_paths[] = ['image_path' => $path];
                //$post->images()->create(['image_path' => $path]);
            }
        }
        $this->merge([
            'post.profile_id' => auth()->user()->id,
            'post.image_paths' => $image_paths,
            'tags' => explode(',', $this->tags)
        ]);
    }
}
