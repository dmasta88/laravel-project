<?php

namespace App\Http\Requests\Client\Comment;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class ReplyCommentRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => 'required|string',
            'parent_id' => 'required|integer|exists:comments,id',
            'profile_id' => 'required|integer|exists:profiles,id'
        ];
    }
    public function prepareForValidation()
    {
        $this->merge(
            [
                'profile_id' => Auth::user()->profile->id,
            ]
        );
    }
}
