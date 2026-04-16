<?php

namespace App\Http\Requests\Api\V1;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        $member = $this->route('member');

        if (! $member instanceof User || ! $this->user()) {
            return true;
        }

        return $this->user()->id === $member->id
            || $this->user()->role->value === 'admin';
    }

    public function rules(): array
    {
        $member = $this->route('member');
        $memberId = $member instanceof User ? $member->id : 0;

        // During Scribe extraction there is no authenticated user; show full field list (admin-capable).
        $isAdmin = ! $this->user() || $this->user()->role === UserRole::Admin;

        return [
            'full_name' => ['sometimes', 'string', 'max:255'],
            'email' => ['sometimes', 'nullable', 'email', 'unique:users,email,' . $memberId],
            'family_id' => $isAdmin
                ? ['sometimes', 'nullable', 'integer', 'exists:families,id']
                : ['prohibited'],
            'pending_family_name' => ['sometimes', 'nullable', 'string', 'max:255'],
            'workplace' => ['sometimes', 'nullable', 'string', 'max:255'],
            'current_job' => ['sometimes', 'nullable', 'string', 'max:255'],
            'city' => ['sometimes', 'nullable', 'string', 'max:100'],
            'region' => ['sometimes', 'nullable', 'string', 'max:100'],
            'bio' => ['sometimes', 'nullable', 'string'],
            'social_links' => ['sometimes', 'nullable', 'array'],
            'profile_image' => ['sometimes', 'nullable', 'image', 'max:5120'],
        ];
    }
}
