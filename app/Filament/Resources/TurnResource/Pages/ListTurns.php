<?php

namespace App\Filament\Resources\TurnResource\Pages;

use App\Filament\Resources\TurnResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTurns extends ListRecords
{
    protected static string $resource = TurnResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
