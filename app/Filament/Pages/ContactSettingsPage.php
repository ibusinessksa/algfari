<?php

namespace App\Filament\Pages;

use App\Models\AppSetting;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ContactSettingsPage extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-phone';

    protected static string $view = 'filament.pages.contact-settings';

    public ?array $data = [];

    public static function getNavigationGroup(): ?string
    {
        return __('admin_panel.nav.communication');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin_panel.contact_settings.nav');
    }

    public function getTitle(): string
    {
        return __('admin_panel.contact_settings.title');
    }

    public function mount(): void
    {
        $s = AppSetting::current();
        $this->form->fill([
            'contact_phone' => $s->contact_phone,
            'contact_whatsapp' => $s->contact_whatsapp,
            'contact_email' => $s->contact_email,
            'twitter_url' => $s->twitter_url,
            'instagram_url' => $s->instagram_url,
            'snapchat_url' => $s->snapchat_url,
            'tiktok_url' => $s->tiktok_url,
            'youtube_url' => $s->youtube_url,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make(__('admin_panel.contact_settings.section'))->schema([
                Forms\Components\TextInput::make('contact_phone')->label(__('admin_panel.common.phone'))->tel(),
                Forms\Components\TextInput::make('contact_whatsapp')->label(__('admin_panel.common.whatsapp'))->tel(),
                Forms\Components\TextInput::make('contact_email')->label(__('admin_panel.common.email'))->email(),
            ])->columns(3),

            Forms\Components\Section::make(__('admin_panel.contact_settings.social'))->schema([
                Forms\Components\TextInput::make('twitter_url')->label('Twitter / X')->url(),
                Forms\Components\TextInput::make('instagram_url')->label('Instagram')->url(),
                Forms\Components\TextInput::make('snapchat_url')->label('Snapchat')->url(),
                Forms\Components\TextInput::make('tiktok_url')->label('TikTok')->url(),
                Forms\Components\TextInput::make('youtube_url')->label('YouTube')->url(),
            ])->columns(2),
        ])->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        AppSetting::current()->fill($data)->save();

        Notification::make()->title(__('messages.updated'))->success()->send();
    }

    protected function getFormActions(): array
    {
        return [Action::make('save')->label(__('messages.updated'))->submit('save')];
    }
}
