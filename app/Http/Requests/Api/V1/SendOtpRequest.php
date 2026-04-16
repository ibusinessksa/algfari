<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SendOtpRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone_number' => [
                'required',
                'string',
                'max:20',
                Rule::when($this->input('purpose') === 'reset', [
                    Rule::exists('users', 'phone_number')->whereNull('deleted_at'),
                ]),
            ],
            'purpose' => ['required', 'string', 'in:register,reset,verify'],
        ];
    }
}
