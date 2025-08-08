<?php

namespace App\Http\Requests\Client\Notification;

use Illuminate\Foundation\Http\FormRequest;

class IndexNotificationRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'page' => 'nullable|integer',
            'per_page' => 'nullable|integer',
        ];
    }
    public function prepareForValidation()
    {
        $this->merge([
            'page' => $this->page ?? 1,
            'per_page' => $this->per_page ?? 10
        ]);
        return '';
    }
}
