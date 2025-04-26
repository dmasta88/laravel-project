<?php

namespace App\Http\Requests\Tag;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => "required|string|unique:tags,title"
        ];
    }
    public function messages()
    {
        return [
            "title.required" => "The field title is required!",
            "title.unique" => "Tag with such name already exists, please enter another name",
        ];
    }
}
