<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

    public function getTabs(): array
    {
        return [
            'همه' => Tab::make(),
            'unRead' => Tab::make()->label('خوانده نشده')->modifyQueryUsing(fn (Builder $query) => $query->where('read_at', null)),
            'Read' => Tab::make()->label('خوانده شده')->modifyQueryUsing(fn (Builder $query) => $query->whereNot('read_at', null)),
        ];
    }
}
