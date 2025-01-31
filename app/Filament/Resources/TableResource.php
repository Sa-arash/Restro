<?php

namespace App\Filament\Resources;

use App\Enums\FreeUse;
use App\Filament\Resources\TableResource\Pages;
use App\Filament\Resources\TableResource\RelationManagers;
use App\Models\Table as TableModel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class TableResource extends Resource
{
    protected static ?string $model = TableModel::class;
    protected static ?string $label = "میز";
    protected static ?string $pluralLabel = 'میز ها';
    protected static ?string $navigationLabel = 'میز ها';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')->label('عنوان')->required(),
                Forms\Components\TextInput::make('code')->label('کد میز')->required(),
                Forms\Components\Hidden::make('qr_code')->default(fn()=>Str::random(6))->required(),
                Forms\Components\Textarea::make('description')->label('توضیحات')->columnSpanFull(),

//                \LaraZeus\Qr\Components\Qr::make('qr_code')
//                    // to open the designer as slide over instead of a modal.
//                    // Comment it out if you prefer the modal.
//                    ->asSlideOver()
//                    // you can set the column you want to save the QR design options, you must cast it to array in your model
//                    ->optionsColumn('options')
//
//                    // set the icon for the QR action
//                    ->actionIcon('heroicon-s-building-library')->default(['qr_code'=>'dawa'])->disabled()
            ])->columns(2);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('')->rowIndex(),
                Tables\Columns\TextColumn::make('title')->label('عنوان')->searchable(),
                Tables\Columns\TextColumn::make('code')->label('کد میز')->searchable(),
                Tables\Columns\TextColumn::make('status')->badge()->label('وضعیت')->searchable(),
                Tables\Columns\TextColumn::make('description')->label('توضیحات'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label(''),
                Tables\Actions\ViewAction::make()->label(''),
                Tables\Actions\DeleteAction::make()->label(''),
                Tables\Actions\Action::make('qr-action')
                    ->fillForm(fn( $record) => [
                        'qr-options' => \LaraZeus\Qr\Facades\Qr::getDefaultOptions(),// or $record->qr-options
                        'qr-data' => $record->url
                    ])
                    ->form(\LaraZeus\Qr\Facades\Qr::getFormSchema('qr-data', 'qr-options'))
                    ->action(fn($data) => dd($data)),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTables::route('/'),
            'create' => Pages\CreateTable::route('/create'),
            'edit' => Pages\EditTable::route('/{record}/edit'),
        ];
    }
}
