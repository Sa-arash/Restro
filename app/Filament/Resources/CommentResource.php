<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CommentResource\Pages;
use App\Filament\Resources\CommentResource\RelationManagers;
use App\Models\Comment;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use IbrahimBougaoua\FilamentRatingStar\Columns\Components\RatingStar;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Notifications\Actions\Action;


class CommentResource extends Resource
{
    protected static ?string $model = Comment::class;
    protected static ?string $label="نظر";
    protected static ?string $pluralLabel="نظرات";

    protected static ?string $navigationIcon = 'heroicon-s-chat-bubble-oval-left';

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
                Tables\Columns\TextColumn::make('')->rowIndex(),
                Tables\Columns\TextColumn::make('user.name')->url(fn($record)=>UserResource::getUrl('view',['record'=>$record->user_id]))->label('کاربر')->color('a')->badge()->sortable()->alignCenter(),
                Tables\Columns\TextColumn::make('product.title')->url(fn($record)=>ProductResource::getUrl('view',['record'=>$record->product_id]))->label('محصول')->color('a')->badge()->sortable()->alignCenter(),
                Tables\Columns\TextColumn::make('is_show')->badge()->label('وضعیت')->alignCenter(),
                Tables\Columns\TextColumn::make('comment')->tooltip(fn($record)=>$record->comment)->limit(30)->label(' متن ')->alignCenter(),
                Tables\Columns\TextColumn::make('reply')->tooltip(fn($record)=>$record->reply)->limit(30)->label('متن ادمین')->alignCenter(),
                RatingStar::make('star')->label('امتیاز')->alignCenter(),
                Tables\Columns\TextColumn::make('created_at')->label('تاریخ ثبت')->alignCenter()->jalaliDateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->color('show')->tooltip('نمایش نظر کاربر')->infolist(function ($record){
                    $record->update(['read_at'=>now()]);
                    return [
                        Section::make([
                            TextEntry::make('user.name')->label('نام و نام خانوادگی'),
                            TextEntry::make('product.title')->label('محصول'),
                            \IbrahimBougaoua\FilamentRatingStar\Entries\Components\RatingStar::make('star')->label('امتیاز'),
                            TextEntry::make('comment')->markdown()->label('متن')->columnSpanFull(),
                            TextEntry::make('reply')->label('نظر ادمین')->columnSpanFull(),
                            TextEntry::make('created_at')->jalaliDateTime()->label('تاریخ ثبت'),
                            TextEntry::make('read_at')->jalaliDateTime()->label('تاریخ خواندن'),
                        ])->columns(3)
                    ];
                }),

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

                    Notification::make('change')->success()->title('وضعیت نظر ثبت شد ')->send();
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
        ];
    }
}
