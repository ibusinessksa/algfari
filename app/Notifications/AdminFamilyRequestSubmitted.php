<?php

namespace App\Notifications;

use App\Models\FamilyRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminFamilyRequestSubmitted extends Notification
{
    use Queueable;

    public function __construct(
        public FamilyRequest $familyRequest
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $this->familyRequest->loadMissing('user');

        return [
            'title' => [
                'ar' => 'طلب تعريف عائلة',
                'en' => 'New family assignment request',
            ],
            'body' => [
                'ar' => sprintf(
                    'العضو %s يطلب اعتماد العائلة: %s',
                    $this->familyRequest->user?->full_name ?? '',
                    $this->familyRequest->user?->pending_family_name ?? $this->familyRequest->name
                ),
                'en' => sprintf(
                    'Member %s requested family: %s',
                    $this->familyRequest->user?->full_name ?? '',
                    $this->familyRequest->user?->pending_family_name ?? $this->familyRequest->name
                ),
            ],
            'type' => 'family_request_submitted',
            'family_request_id' => $this->familyRequest->id,
        ];
    }
}
