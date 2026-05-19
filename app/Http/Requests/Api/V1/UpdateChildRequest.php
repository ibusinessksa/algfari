<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateChildRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'gender' => ['sometimes', 'required', Rule::in(['male', 'female'])],
            'birthday' => ['sometimes', 'required', 'date', 'before_or_equal:today'],
        ];
    }
}
