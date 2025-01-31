<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CategoryResource\Pages;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;
    protected static ?string $label="دسته بندی";
    protected static ?string $pluralLabel="دسته بندی";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image')->label('تصویر')->columnSpanFull(),
                Forms\Components\TextInput::make('title')->live(true)->afterStateUpdated(function (Forms\Set $set,$state){
                    $set('slug',Str::slug($state));
                })->label('عنوان دسته بندی')->required()->maxLength(255),
                Forms\Components\TextInput::make('slug')->required()->label('اسلاگ')->maxLength(255)->default(null),
                Forms\Components\Select::make('parent_id')->columnSpanFull()->label('دسته بندی والد')->searchable()->preload()->options(Category::query()->pluck('title','id'))->default(null),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('sort')->reorderable('sort')
            ->columns([
                Tables\Columns\TextColumn::make('')->rowIndex(),
                Tables\Columns\ImageColumn::make('image')->label('تصویر')->width(70)->height(70)->alignCenter(),
                Tables\Columns\TextColumn::make('title')->label('عنوان')->alignCenter()->searchable(),
                Tables\Columns\TextColumn::make('slug')->label('اسلاگ')->searchable(),
                Tables\Columns\TextColumn::make('parent.title')->label('دسته بندی والد')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListCategories::route('/'),
//            'create' => Pages\CreateCategory::route('/create'),
//            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
