<?php

namespace App\Http\Requests\Profile;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfileRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'second_name' => 'required|string',
            'third_name' => 'required|string',
            'avatar' => 'nullable|string',
            'city' => 'nullable|string',
            'login' => 'required|string|unique:profiles,login',
            'user_id' => 'required|integer'
        ];
    }
}
