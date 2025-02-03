<?php

namespace App\Filament\Pages;

use App\Models\Table;
use Filament\Pages\Page;

class TableStatus extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $title="میز های درحال استفاده";

    protected static string $view = 'filament.pages.table-status';
    protected function getHeaderWidgets(): array
    {
        return [
            \App\Filament\Widgets\TableStatus::class
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return Table::query()->where('status','use')->count();
    }
}
