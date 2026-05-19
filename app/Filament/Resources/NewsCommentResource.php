<?php

namespace App\Filament\Resources;

use App\Enums\NewsCommentStatus;
use App\Filament\Resources\NewsCommentResource\Pages;
use App\Models\NewsComment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class NewsCommentResource extends Resource
{
    protected static ?string $model = NewsComment::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';

    public static function getNavigationGroup(): ?string
    {
        return __('admin_panel.nav.communication');
    }

    public static function getModelLabel(): string
    {
        return __('admin_panel.news_comment.model');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin_panel.news_comment.plural');
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Select::make('news_id')
                ->label(__('admin_panel.news.model'))
                ->relationship('news', 'title')
                ->disabled(),
            Forms\Components\Select::make('user_id')
                ->label(__('admin_panel.common.submitter'))
                ->relationship('user', 'full_name')
                ->disabled(),
            Forms\Components\Textarea::make('content')
                ->label(__('admin_panel.common.content'))
                ->columnSpanFull()
                ->rows(4),
            Forms\Components\Select::make('status')
                ->label(__('admin_panel.common.status'))
                ->options(NewsCommentStatus::class)
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.full_name')
                    ->label(__('admin_panel.common.submitter'))
                    ->searchable(),
                Tables\Columns\TextColumn::make('content')
                    ->label(__('admin_panel.common.content'))
                    ->limit(60)
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label(__('admin_panel.common.status'))
                    ->formatStateUsing(fn (NewsCommentStatus $state) => $state->label())
                    ->badge()
                    ->color(fn (NewsCommentStatus $state) => $state->color()),
                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('admin_panel.common.date'))
                    ->dateTime()
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\SelectFilter::make('status')->options(NewsCommentStatus::class),
            ])
            ->actions([
                Tables\Actions\Action::make('approve')
                    ->label(__('admin_panel.news_comment.approve'))
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn (NewsComment $r) => $r->status !== NewsCommentStatus::Approved)
                    ->action(fn (NewsComment $r) => $r->update([
                        'status' => NewsCommentStatus::Approved,
                        'reviewed_by' => auth()->id(),
                        'reviewed_at' => now(),
                    ])),
                Tables\Actions\Action::make('reject')
                    ->label(__('admin_panel.news_comment.reject'))
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->visible(fn (NewsComment $r) => $r->status !== NewsCommentStatus::Rejected)
                    ->action(fn (NewsComment $r) => $r->update([
                        'status' => NewsCommentStatus::Rejected,
                        'reviewed_by' => auth()->id(),
                        'reviewed_at' => now(),
                    ])),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getPages(): array
    {
        return ['index' => Pages\ListNewsComments::route('/')];
    }
}
