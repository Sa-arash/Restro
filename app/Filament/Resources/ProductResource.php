<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Support\Enums\IconSize;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $label = "محصول";
    protected static ?string $pluralLabel = "محصولات";
    protected static ?string $navigationIcon = 'food';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Tabs')
                    ->tabs([
                        Tabs\Tab::make('محصول')
                            ->schema([
                                Forms\Components\FileUpload::make('images')->image()->label('تصویر')->required()->columnSpanFull(),
                                Forms\Components\TextInput::make('title')->live(true)->afterStateUpdated(function (Forms\Set $set, $state) {
                                    $set('slug', Str::slug($state));
                                })->label('عنوان محصول')->required()->maxLength(255),
                                Forms\Components\TextInput::make('slug')->label('اسلاگ')->required()->maxLength(255),
                                Forms\Components\Section::make([
                                    Forms\Components\Select::make('category_id')->label(' دسته بندی')->required()->relationship('category', 'title')->preload()->searchable(),
                                    Forms\Components\TextInput::make('price')->suffix('تومان')->mask(RawJs::make('$money($input)'))->stripCharacters(',')->label('قیمت')->required()->maxLength(64),
                                    Forms\Components\TextInput::make('inventory')->default(0)->label('موجودی')->numeric()->required()->maxLength(64),
                                    Forms\Components\TextInput::make('min_inventory')->default(0)->label('حداقل موجودی')->numeric()->required()->maxLength(64),
                                ])->columns(4),
                                Forms\Components\Textarea::make('description')->columnSpanFull()->maxLength(4000)->label('توضیحات')->required(),
                            ])->columns(),
                        Tabs\Tab::make('تخفیف')
                            ->schema([
                                Forms\Components\TextInput::make('discount')->label('درصد تخفیف')
                                    ->rules([
                                        fn(): Closure => function (string $attribute, $value, Closure $fail) {
                                            if ($value < 0 || $value > 100) {
                                                $fail('مقدار :attribute باید بین 0 تا 100 باشد.');
                                            }
                                        }
                                    ])
                                    ->maxLength(255)->default(null),
                                Forms\Components\DatePicker::make('discount_end')->label('تاریخ پایان تخفیف'),
                            ])->columns(),

                    ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('')->rowIndex(),
                Tables\Columns\ImageColumn::make('images')->alignCenter()->label('تصویر')->width(70)->height(70)->alignCenter(),
                Tables\Columns\TextColumn::make('title')->tooltip(fn($record) => $record->description)->label('عنوان محصول')->searchable()->alignCenter(),
                Tables\Columns\TextColumn::make('category.title')->label('دسته بندی')->sortable()->alignCenter(),
                Tables\Columns\TextColumn::make('price')->label('قیمت ')->numeric()->searchable(),
                //                Tables\Columns\TextColumn::make('discount')
                //                    ->searchable(),
                //                Tables\Columns\TextColumn::make('discount_end')
                //                    ->date()
                //                    ->sortable(),
                Tables\Columns\TextColumn::make('inventory')->description(fn($record) => "حداقل موجودی : " . $record->min_inventory)->label('موجودی')->alignCenter()->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('special_on')->requiresConfirmation()->action(function ($record){
                    $record->update(['special_offer'=>1]);
                    Notification::make('success')->success()->title('محصول به پیشنهاد ویژه اضافه شد')->color('success')->send();
                })->icon('heroicon-o-star')->iconSize(IconSize::Large)->tooltip('اضافه به پیشنهاد ویژه')->label(' اضافه به پیشنهاد ویژه')->hidden(fn($record)=>$record->special_offer),
                Tables\Actions\Action::make('special_off')->requiresConfirmation()->action(function ($record){
                    $record->update(['special_offer'=>0]);
                    Notification::make('success')->success()->title('محصول از پیشنهاد ویژه حذف شد')->color('success')->send();
                })->icon('star-slash')->iconSize(IconSize::Large)->tooltip('حذف از پیشنهاد ویژه')->label(' حذف  از پیشنهاد ویژه')->visible(fn($record)=>$record->special_offer)
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
