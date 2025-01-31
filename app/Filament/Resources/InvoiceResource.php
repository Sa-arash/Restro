<?php

namespace App\Filament\Resources;

use App\Enums\InvoiceStatus;
use App\Filament\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\User;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('اطلاعات سفارش')
                    ->schema([
                        Forms\Components\Select::make('user_id')->label('انتخاب کاربر')
                            ->relationship('user', 'name')->live()->afterStateUpdated(function (Set $set, $state) {
                                if($state){
                                $user = User::find($state);
                                $set('name', $user->name);
                                $set('phone', '911');
                                }else{
                                    $set('name', null);
                                $set('phone', null);
                                }
                            })->searchable()->preload(),
                        Forms\Components\TextInput::make('name')->label('نام')
                            ->required(),
                        Forms\Components\TextInput::make('phone')->label('شماره تلفن')
                            ->tel()
                            ->required(),

                        Forms\Components\Select::make('table_id')
                            ->label('میز')
                            ->relationship('table', 'title')->searchable()->preload()
                            ->required(),

                        Forms\Components\DatePicker::make('order_date')
                            ->default(now())
                            ->label('تاریخ سفارش')
                            ->required(),
                        Forms\Components\DatePicker::make('payment_date')
                            ->default(now())
                            ->label('تاریخ خرید'),
                        Forms\Components\ToggleButtons::make('status')
                            ->default('order')
                            ->options(InvoiceStatus::class)->label('وضعیت')->inline()->columnSpan(2)
                            ->required(),
                    ])->columns(4),


                Repeater::make('products')->relationship('items')
                ->label('محصولات')
               
                    ->schema([
                        Select::make('product_id')->label('محصول')
                            ->relationship('product', 'title')->searchable()->preload()->live()->afterStateUpdated(function (Set $set, $state) {
                                if($state){
                                    $product = Product::find($state);
                                    if($product->discount){
                                        $set('price',number_format(makeDiscount($product->price,$product->discount)));
                                        $set('discount',$product->discount);
                                    }else{
                                        $set('price', number_format($product->price));
                                    }
                                }else{
                                    $set('price',null);
                                        $set('discount',null);
                                }
                            })->searchable()->preload()
                            ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                            ->required(),

                        TextInput::make('price')->label('قیمت')
                        ->readOnly()
                            ->required()->mask(RawJs::make('$money($input)'))->stripCharacters(','),

                        TextInput::make('count')->label('تعداد')
                            ->default(1)
                            ->numeric()
                            ->required(),

                        TextInput::make('discount')->label('درصد تخفیف')
                            ->default(0)
                            ->rules([
                                fn (): Closure => function (string $attribute, $value, Closure $fail) {
                                    if ($value < 0 || $value > 100) {
                                        $fail('مقدار :attribute باید بین 0 تا 100 باشد.');
                                    }
                                }])
                            ->required(),
                       




                    ])->columns(4)->columnSpanFull(),

                Forms\Components\TextInput::make('total_discount')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('total_amount')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('table_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_discount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListInvoices::route('/'),
            'create' => Pages\CreateInvoice::route('/create'),
            'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
