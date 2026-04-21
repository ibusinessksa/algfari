<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string'],
            'device_token' => ['nullable', 'string', 'required_with:platform'],
            'platform' => ['nullable', 'string', 'in:ios,android', 'required_with:device_token'],
        ];
    }
}
