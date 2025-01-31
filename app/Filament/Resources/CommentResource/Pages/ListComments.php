<?php

namespace App\Filament\Resources\CommentResource\Pages;

use App\Filament\Resources\CommentResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListComments extends ListRecords
{
    protected static string $resource = CommentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'همه' => Tab::make(),
            'show' => Tab::make()->label('تایید نشده')->modifyQueryUsing(fn (Builder $query) => $query->where('is_show', false)),
            'notShow' => Tab::make()->label('تایید شده')->modifyQueryUsing(fn (Builder $query) => $query->where('is_show', true    )),
        ];
    }
}
