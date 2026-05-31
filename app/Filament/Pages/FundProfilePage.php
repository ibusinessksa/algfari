<?php

namespace App\Filament\Pages;

use App\Models\FundProfile;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class FundProfilePage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.fund-profile';

    public ?array $data = [];

    public static function getNavigationGroup(): ?string
    {
        return __('admin_panel.nav.finance');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin_panel.fund_profile.nav');
    }

    public function getTitle(): string
    {
        return __('admin_panel.fund_profile.title');
    }

    public function mount(): void
    {
        $profile = FundProfile::current();

        $this->form->fill([
            'about' => $profile->getTranslations('about'),
            'vision' => $profile->getTranslations('vision'),
            'mission' => $profile->getTranslations('mission'),
            'goals' => $profile->getTranslations('goals'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Tabs::make('translations')->tabs([
                Forms\Components\Tabs\Tab::make(__('admin_panel.tabs.arabic'))->schema([
                    Forms\Components\Textarea::make('about.ar')
                        ->label(__('admin_panel.fund_profile.about'))->rows(4),
                    Forms\Components\Textarea::make('vision.ar')
                        ->label(__('admin_panel.fund_profile.vision'))->rows(3),
                    Forms\Components\Textarea::make('mission.ar')
                        ->label(__('admin_panel.fund_profile.mission'))->rows(3),
                    Forms\Components\Textarea::make('goals.ar')
                        ->label(__('admin_panel.fund_profile.goals'))->rows(4),
                ]),
                Forms\Components\Tabs\Tab::make(__('admin_panel.tabs.english'))->schema([
                    Forms\Components\Textarea::make('about.en')
                        ->label(__('admin_panel.fund_profile.about'))->rows(4),
                    Forms\Components\Textarea::make('vision.en')
                        ->label(__('admin_panel.fund_profile.vision'))->rows(3),
                    Forms\Components\Textarea::make('mission.en')
                        ->label(__('admin_panel.fund_profile.mission'))->rows(3),
                    Forms\Components\Textarea::make('goals.en')
                        ->label(__('admin_panel.fund_profile.goals'))->rows(4),
                ]),
            ])->columnSpanFull(),
        ])->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $profile = FundProfile::current();
        $profile->fill([
            'about' => $data['about'] ?? null,
            'vision' => $data['vision'] ?? null,
            'mission' => $data['mission'] ?? null,
            'goals' => $data['goals'] ?? null,
        ])->save();

        Notification::make()
            ->title(__('messages.updated'))
            ->success()
            ->send();
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('messages.save'))
                ->submit('save'),
        ];
    }
}
