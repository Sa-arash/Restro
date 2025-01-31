<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;
    protected static ?string $label="تماس با ما";
    protected static ?string $pluralLabel="تماس با ما";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->maxLength(255),
                Forms\Components\TextInput::make('phone')->tel()->required()->maxLength(255),
                Forms\Components\Textarea::make('comment')->required()->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('')->rowIndex(),
                Tables\Columns\TextColumn::make('name')->label('نام و نام خانوادگی')->searchable()->alignCenter(),
                Tables\Columns\TextColumn::make('phone')->url(fn($record)=>'tel:'.$record->phone)->color('phone')->searchable()->label('شماره تلفن')->alignCenter(),
                Tables\Columns\TextColumn::make('created_at')->label('تاریخ ثبت ')->jalaliDateTime()->sortable()->alignCenter(),
                Tables\Columns\TextColumn::make('read_at')->label('تاریخ خوانده شده ')->jalaliDateTime()->sortable()->alignCenter(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('read')->hidden(fn($record)=>$record->read_at)->label('خوانده شده')->action(fn($record)=>$record->update(['read_at'=>now()]))
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
            'index' => Pages\ListContacts::route('/'),
        ];
    }
}
