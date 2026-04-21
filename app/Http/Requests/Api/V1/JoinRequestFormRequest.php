<?php

namespace App\Http\Requests\Api\V1;

use App\Enums\JoinRequestStatus;
use App\Models\User;
use App\Support\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class JoinRequestFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $rawPhone = Str::squish((string) $this->input('phone_number', ''));
        $normalizedPhone = PhoneNumber::normalizeSaMobile($rawPhone) ?? $rawPhone;

        $fullName = Str::squish((string) $this->input('full_name', ''));

        $pending = $this->input('pending_family_name');
        $pendingTrimmed = null;
        if ($pending !== null && $pending !== '') {
            $pendingTrimmed = Str::squish((string) $pending);
            if ($pendingTrimmed === '') {
                $pendingTrimmed = null;
            }
        }

        $national = $this->input('national_id');
        $nationalDigits = null;
        if ($national !== null && $national !== '') {
            $nationalDigits = preg_replace('/\D+/', '', (string) $national);
            if ($nationalDigits === '') {
                $nationalDigits = null;
            }
        }

        $email = $this->input('email');
        $emailNormalized = null;
        if ($email !== null && $email !== '') {
            $emailNormalized = Str::lower(Str::squish((string) $email));
        }

        $this->merge([
            'full_name' => $fullName,
            'phone_number' => $normalizedPhone,
            'pending_family_name' => $pendingTrimmed,
            'national_id' => $nationalDigits,
            'email' => $emailNormalized,
        ]);
    }

    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'min:3', 'max:255', 'regex:/^[\p{Arabic}a-zA-Z0-9\s\'.-]+$/u'],
            'phone_number' => [
                'required',
                'string',
                'regex:/^05\d{8}$/',
                Rule::unique(User::class, 'phone_number'),
                Rule::unique('join_requests', 'phone_number')->where(
                    fn ($q) => $q->where('status', JoinRequestStatus::Pending->value)
                ),
            ],
            'national_id' => [
                'nullable',
                'string',
                'size:10',
                'regex:/^[12]\d{9}$/',
                Rule::unique(User::class, 'national_id'),
                Rule::unique('join_requests', 'national_id')->where(
                    fn ($q) => $q->where('status', JoinRequestStatus::Pending->value)
                ),
            ],
            'email' => [
                'nullable',
                'string',
                'email:rfc,filter',
                'max:255',
                Rule::unique(User::class, 'email'),
                Rule::unique('join_requests', 'email')->where(
                    fn ($q) => $q->where('status', JoinRequestStatus::Pending->value)
                ),
            ],
            'pending_family_name' => ['nullable', 'string', 'min:2', 'max:255'],
            'region_id' => ['required', 'integer', 'exists:regions,id'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)->letters()->numbers()],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,jpg,png,webp', 'max:5120'],
        ];
    }

    public function messages(): array
    {
        return [
            'full_name.regex' => __('join_request.validation.full_name_format'),
            'phone_number.regex' => __('join_request.validation.phone_format'),
            'phone_number.unique' => __('join_request.validation.phone_taken'),
            'national_id.regex' => __('join_request.validation.national_id_format'),
            'national_id.unique' => __('join_request.validation.national_id_taken'),
            'national_id.size' => __('join_request.validation.national_id_format'),
            'email.unique' => __('join_request.validation.email_taken'),
            'region_id.required' => __('join_request.validation.region_required'),
            'region_id.exists' => __('join_request.validation.region_invalid'),
            'password.min' => __('join_request.validation.password_requirements'),
            'password.letters' => __('join_request.validation.password_requirements'),
            'password.numbers' => __('join_request.validation.password_requirements'),
        ];
    }

    public function attributes(): array
    {
        return [
            'full_name' => __('join_request.fields.full_name'),
            'phone_number' => __('join_request.fields.phone_number'),
            'national_id' => __('join_request.fields.national_id'),
            'email' => __('join_request.fields.email'),
            'pending_family_name' => __('join_request.fields.pending_family_name'),
            'region_id' => __('join_request.fields.region_id'),
            'password' => __('join_request.fields.password'),
            'profile_image' => __('join_request.fields.profile_image'),
        ];
    }
}
