<?php

namespace App\Http\Requests\Like;

use Illuminate\Foundation\Http\FormRequest;

class StoreLikeRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'profile_id' => "required|integer",
            'post_id' => "required|integer"
        ];
    }
}
