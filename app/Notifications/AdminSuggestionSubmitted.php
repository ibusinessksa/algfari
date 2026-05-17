<?php

namespace App\Notifications;

use App\Models\Suggestion;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification as FilamentNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class AdminSuggestionSubmitted extends Notification
{
    use Queueable;

    public function __construct(
        public Suggestion $suggestion
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        $this->suggestion->loadMissing('submitter');

        $locale = app()->getLocale();
        $titleTranslations = [
            'ar' => 'اقتراح جديد للمراجعة',
            'en' => 'New suggestion to review',
        ];
        $bodyTranslations = [
            'ar' => sprintf(
                'العضو %s قدّم اقتراحاً: %s',
                $this->suggestion->submitter?->full_name ?? '',
                $this->suggestion->getTranslation('title', 'ar')
            ),
            'en' => sprintf(
                'Member %s submitted a suggestion: %s',
                $this->suggestion->submitter?->full_name ?? '',
                $this->suggestion->getTranslation('title', 'en')
            ),
        ];

        $url = route('filament.admin.resources.suggestions.index');

        return FilamentNotification::make()
            ->title($titleTranslations[$locale] ?? $titleTranslations['ar'])
            ->body($bodyTranslations[$locale] ?? $bodyTranslations['ar'])
            ->icon('heroicon-o-light-bulb')
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
                'type' => 'suggestion_submitted',
                'suggestion_id' => $this->suggestion->id,
            ];
    }
}
