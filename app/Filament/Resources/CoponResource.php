<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CoponResource\Pages;
use App\Filament\Resources\CoponResource\RelationManagers;
use App\Models\Copon;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class CoponResource extends Resource
{
    protected static ?string $model = Copon::class;
    protected static ?string $label='کد تخفیف  ';
    protected static ?string $pluralLabel='کد های تخفیف ';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')->label('کاربر استفاده کننده')->preload()->searchable()->relationship('user','name')->required(),
                Forms\Components\TextInput::make('token')->label('توکن')->prefixAction(Forms\Components\Actions\Action::make('Generate')->icon('heroicon-m-key')->tooltip('ساخت توکن')->label('ساخت توکن')->action(function (Forms\Set $set){
                    $set('token',Str::random(7));
                }))->required()->maxLength(255),
                Forms\Components\DatePicker::make('start_date')->default(now())->label('تاریخ شروع')->required()->jalali()->closeOnDateSelection(),
                Forms\Components\DatePicker::make('end_date')->after(fn(Forms\Get $get)=> Carbon::create($get('start_date'))->format('Y/m/d'))->label('تاریخ پایان')->required()->jalali()->closeOnDateSelection(),
              Forms\Components\Section::make([
                  Forms\Components\TextInput::make('discount')->maxValue(100)->prefix('%')->default(0)->label('درصد تخفیف')->required()->numeric(),
                  Forms\Components\TextInput::make('min_price')->numeric()->suffix('تومان')->mask(RawJs::make('$money($input)'))->stripCharacters(',')->default(0)->label('حداقل سفارش')->required()->numeric(),
                  Forms\Components\TextInput::make('max_price')->numeric()->suffix('تومان')->mask(RawJs::make('$money($input)'))->stripCharacters(',')->default(0)->label(' حداکثر تخفیف سفارش')->required()->numeric(),
              ])->columns(3),
                Forms\Components\Textarea::make('description')->columnSpanFull()->label('توضیحات'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('')->rowIndex(),
                Tables\Columns\TextColumn::make('user.name')->color('a')->badge()->sortable()->label('کاربر')->alignCenter(),
                Tables\Columns\TextColumn::make('token')->badge()->label('توکن')->searchable()->alignCenter(),
                Tables\Columns\TextColumn::make('start_date')->jalaliDate()->label('تاریخ شروع')->sortable()->alignCenter(),
                Tables\Columns\TextColumn::make('end_date')->jalaliDate()->label('تاریخ پایان ')->sortable()->alignCenter(),
                Tables\Columns\TextColumn::make('min_price')->label('حداقل سفارش')->numeric()->sortable()->alignCenter(),
                Tables\Columns\TextColumn::make('max_price')->label('حداکثر تخفیف سفارش')->numeric()->sortable()->alignCenter(),
                Tables\Columns\TextColumn::make('status')->badge()->label('توکن')->label('وضعیت کد')->alignCenter(),
                Tables\Columns\TextColumn::make('created_at')->jalaliDateTime()->sortable()->label('تاریخ ساخت کد')->alignCenter()

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListCopons::route('/'),
            'create' => Pages\CreateCopon::route('/create'),
            'view' => Pages\ViewCopon::route('/{record}'),
            'edit' => Pages\EditCopon::route('/{record}/edit'),
        ];
    }
}
