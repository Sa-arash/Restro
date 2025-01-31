<?php

namespace App\Filament\Resources\CoponResource\Pages;

use App\Filament\Resources\CoponResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCopon extends EditRecord
{
    protected static string $resource = CoponResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
