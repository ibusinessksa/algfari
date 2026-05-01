<?php

namespace App\Http\Requests\Api\V1;

use App\Enums\JoinRequestStatus;
use App\Models\User;
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
                Rule::when($this->input('purpose') === 'register', [
                    Rule::unique('join_requests', 'phone_number')
                        ->where(fn ($query) => $query->where('status', JoinRequestStatus::Pending->value)),
                    function (string $attribute, mixed $value, \Closure $fail): void {
                        if (
                            User::query()
                                ->where('phone_number', (string) $value)
                                ->whereNull('deleted_at')
                                ->exists()
                        ) {
                            $fail(__('auth.phone_already_registered'));
                        }
                    },
                ]),
                Rule::when($this->input('purpose') === 'reset', [
                    Rule::exists('users', 'phone_number')->whereNull('deleted_at'),
                ]),
            ],
            'purpose' => ['required', 'string', 'in:register,reset,verify'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone_number.unique' => __('join_request.validation.phone_pending_request'),
        ];
    }
}
