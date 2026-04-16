<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class VerifyOtpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone_number' => ['required', 'string'],
            'code' => ['required', 'string', 'size:6'],
            'purpose' => ['required', 'string', 'in:register,reset,verify'],
        ];
    }
}
