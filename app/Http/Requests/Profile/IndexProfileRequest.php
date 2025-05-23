<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class IndexProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'second_name' => 'nullable|string',
            'third_name' => 'nullable|string',
            'avatar' => 'nullable|boolean',
            'city' => 'nullable|string',
        ];
    }
}
