<?php

namespace App\Notifications;

use App\Models\SupportRequest;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminSupportRequestSubmitted extends Notification
{
    use Queueable;

    public function __construct(
        public SupportRequest $supportRequest
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        $this->supportRequest->loadMissing('user');

        $locale = app()->getLocale();
        $titleTranslations = [
            'ar' => 'طلب مساعدة جديد',
            'en' => 'New support request',
        ];
        $bodyTranslations = [
            'ar' => sprintf(
                'العضو %s قدّم طلب مساعدة: %s',
                $this->supportRequest->user?->full_name ?? '',
                $this->supportRequest->title
            ),
            'en' => sprintf(
                'Member %s submitted a support request: %s',
                $this->supportRequest->user?->full_name ?? '',
                $this->supportRequest->title
            ),
        ];

        $url = route('filament.admin.resources.support-requests.index');

        return FilamentNotification::make()
            ->title($titleTranslations[$locale] ?? $titleTranslations['ar'])
            ->body($bodyTranslations[$locale] ?? $bodyTranslations['ar'])
            ->icon('heroicon-o-hand-raised')
            ->iconColor('warning')
            ->actions([
                Action::make('view')
                    ->label($locale === 'ar' ? 'عرض' : 'View')
                    ->url($url)
                    ->markAsRead(),
            ])
            ->getDatabaseMessage()
            + [
                'title_translations' => $titleTranslations,
                'body_translations' => $bodyTranslations,
                'type' => 'support_request_submitted',
                'support_request_id' => $this->supportRequest->id,
            ];
    }
}
