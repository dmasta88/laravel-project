<?php

namespace App\Http\Requests\Post;

use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'post.title' => 'required|string|unique:posts,title,' . $this['post']['id'],
            'post.content' => 'nullable|string',
            'post.images' => 'nullable',
            'post.images.*' => 'file|mimes:jpg,png',
            'post.video' => 'nullable|string',
            'post.profile_id' => 'required|integer|exists:profiles,id',
            'post.published_at' => 'nullable|date_format:Y-m-d',
            'post.category_id' => 'required|exists:categories,id',
            'post.is_active' => 'required|in:true,false,1,0',
            'post.image_paths' => 'nullable|array',
            'post.images_deleted' => 'nullable|array',
            'tags' => 'nullable|array'
        ];
    }
    protected function prepareForValidation()
    {
        $image_paths = [];
        //dd($images);
        if (isset($this['post']['images'])) {
            $images = $this['post']['images'];
            foreach ($images as $image) {
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
