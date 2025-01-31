<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Filament\Resources\CommentResource\RelationManagers;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use IbrahimBougaoua\FilamentRatingStar\Columns\Components\RatingStar;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;
    protected static ?string $label="نظر";
    protected static ?string $pluralLabel="نظرات";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')->required()->relationship('user','name')->searchable()->preload()->label('کاربر'),
                Forms\Components\Select::make('product_id')->required()->relationship('product','title')->searchable()->preload()->label('محصول'),
                Forms\Components\Textarea::make('comment')->label('نظر')->required()->columnSpanFull(),
                \IbrahimBougaoua\FilamentRatingStar\Forms\Components\RatingStar::make('star')->label('امتیاز')->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('کاربر')->color('a')->badge()->sortable()->alignCenter(),
                Tables\Columns\TextColumn::make('product.title')->label('محصول')->color('a')->badge()->sortable()->alignCenter(),
                Tables\Columns\IconColumn::make('is_show')->label('وضعیت')->boolean()->alignCenter(),
                Tables\Columns\TextColumn::make('comment')->tooltip(fn($record)=>$record->comment)->limit(30)->label(' متن ')->alignCenter(),
                Tables\Columns\TextColumn::make('reply')->tooltip(fn($record)=>$record->reply)->limit(30)->label('متن ادمین')->alignCenter(),
                RatingStar::make('star')->label('امتیاز')->alignCenter(),
                Tables\Columns\TextColumn::make('created_at')->label('تاریخ ثبت')->alignCenter()->jalaliDateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('send')->fillForm(function ($record){
                    return [
                        'is_show'=>$record->is_show,
                        'reply'=>$record->reply,
                    ];
                })->label('تایید وضعیت')->form([
                    Forms\Components\ToggleButtons::make('is_show')->required()->grouped()->boolean('تایید','رد')->label('وضعیت'),
                    Forms\Components\Textarea::make('reply')->columnSpanFull()->label('پاسخ'),
                ])->action(function ($data,$record){
                    $record->update([
                        'is_show'=>$data['is_show'],
                        'reply'=>$data['reply'],
                    ]);
                    Notification::make('change')->success()->title('ثبت شد ')->send();
                })->requiresConfirmation()
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
            'index' => Pages\ListComments::route('/'),
            'create' => Pages\CreateComment::route('/create'),
            'edit' => Pages\EditComment::route('/{record}/edit'),
        ];
    }
}
