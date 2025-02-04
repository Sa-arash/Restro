<?php

namespace App\Filament\Pages;

use App\Models\Table;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Filament\Pages\Page;

class TableStatus extends Page
{
    use HasPageShield;
    protected static ?string $navigationIcon = 'chair';
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
