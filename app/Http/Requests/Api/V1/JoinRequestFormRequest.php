<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class JoinRequestFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20'],
            'national_id' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email'],
            'pending_family_name' => ['nullable', 'string', 'max:255'],
            'region_id' => ['nullable', 'integer', 'exists:regions,id'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'profile_image' => ['nullable', 'image', 'max:5120'],
        ];
    }
}
