<?php

namespace App\Filament\Resources\CoponResource\Pages;

use App\Filament\Resources\CoponResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCopons extends ListRecords
{
    protected static string $resource = CoponResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
