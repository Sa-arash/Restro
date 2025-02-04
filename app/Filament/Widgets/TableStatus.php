<?php

namespace App\Filament\Widgets;

use App\Enums\FreeUse;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Forms\Components\ToggleButtons;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TableStatus extends BaseWidget
{
    use HasWidgetShield;
    protected int | string | array $columnSpan='full';
    protected static ?int $sort=3;


    public function table(Table $table): Table
    {
        return $table->emptyStateHeading('هیچ میز درحال استفاده ای نیست')->heading('میز های درحال استفاده')
            ->query(
                \App\Models\Table::query()->where('status','use')
            )
            ->columns([
                Tables\Columns\TextColumn::make('')->rowIndex(),
                Tables\Columns\TextColumn::make('title')->label('عنوان')->searchable(),
                Tables\Columns\TextColumn::make('code')->label('کد میز')->searchable(),
                Tables\Columns\TextColumn::make('status')->badge()->label('وضعیت'),
                Tables\Columns\TextColumn::make('description')->label('توضیحات'),

            ])->actions([
                Tables\Actions\Action::make('change')->label('تغییر وضعیت میز')->action(function ($record){
                    $record->update(['status'=>'free']);
                })->requiresConfirmation()->modalSubmitActionLabel('میز خالی شد'),
            ]);
    }
}
