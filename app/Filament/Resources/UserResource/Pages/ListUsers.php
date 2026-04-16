<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    /** @var string System admin account hidden from the members table. */
    private const EXCLUDED_LIST_EMAIL = 'admin@familytribe.app';

    protected function getTableQuery(): ?Builder
    {
        $query = parent::getTableQuery();

        if ($query === null) {
            return null;
        }

        return $query->where(function (Builder $q): void {
            $q->whereNull('email')
                ->orWhere('email', '!=', self::EXCLUDED_LIST_EMAIL);
        });
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
