<?php

namespace App\Http\Requests;

use App\Constants\UserGender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'username' => [
                'required',
                'regex:/^[a-zA-Z0-9_-]+$/',
                Rule::unique('users', 'username')->ignore($this->user->id, 'id'),
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($this->user->id, 'id'),
            ],
            'phone' => 'nullable|max:14',
            'date' => 'nullable|date',
            'gender' => 'nullable|in:'.UserGender::MALE.','.UserGender::FEMALE
        ];
    }
}
