<?php

namespace App\Filament\Resources;

use App\Enums\InvoiceStatus;
use App\Filament\Resources\InvoiceResource\Pages;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Turn;
use App\Models\User;
use Closure;
use Filament\Forms;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\RawJs;
use Filament\Tables;
use Filament\Tables\Table;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $label = "سفارش";
    protected static ?string $pluralLabel = 'سفارش ها';
    protected static ?string $navigationLabel = 'سفارش ها';

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('اطلاعات سفارش')
                    ->schema([
                        Forms\Components\Select::make('user_id')->prefixIcon('heroicon-o-user-group')->prefixIconColor('icon')->label('انتخاب کاربر')
                            ->relationship('user', 'name')->live()->afterStateUpdated(function (Set $set, $state) {
                                if ($state) {
                                    $user = User::find($state);
                                    $set('name', $user->name);
                                    $set('phone', '911');
                                } else {
                                    $set('name', null);
                                    $set('phone', null);
                                }
                            })->searchable()->preload()->columnSpan(['default'=>4,'sm'=>1,'md'=>1,'xl'=>1,'2xl'=>1]),
                        Forms\Components\TextInput::make('name')->label('نام')->required()->columnSpan(['default'=>4,'sm'=>1,'md'=>1,'xl'=>1,'2xl'=>1]),
                        Forms\Components\TextInput::make('phone')->columnSpan(['default'=>4,'sm'=>1,'md'=>1,'xl'=>1,'2xl'=>1])->minLength(11)->maxLength(11)->prefixIcon('heroicon-s-device-phone-mobile')->prefixIconColor('icon')->label('شماره تلفن')->tel()->required(),
                        Forms\Components\Select::make('table_id')->columnSpan(['default'=>4,'sm'=>1,'md'=>1,'xl'=>1,'2xl'=>1])->prefixIcon('chair')->prefixIconColor('icon')->label('میز')->relationship('table', 'title')->searchable()->preload()->required()->disableOptionWhen(fn (string $value): bool => \App\Models\Table::query()->firstWhere('id',$value)?->status === 'use'),
                        Forms\Components\DatePicker::make('order_date')->columnSpan(['default'=>4,'sm'=>1,'md'=>1,'xl'=>1,'2xl'=>1])->default(now())->label('تاریخ ثبت سفارش')->jalali()->required(),
                        Forms\Components\DatePicker::make('payment_date')->columnSpan(['default'=>4,'sm'=>1,'md'=>1,'xl'=>1,'2xl'=>1])->jalali()->default(now())->label('تاریخ پرداخت'),
                        Forms\Components\ToggleButtons::make('status')->columnSpan(['default'=>4,'sm'=>2,'md'=>2,'xl'=>2,'2xl'=>2])->default('order')->options(InvoiceStatus::class)->label('وضعیت')->inline()->columnSpan(2)->required(),
                    ])->columns(4),
                Repeater::make('products')->relationship('items')
                    ->label('محصولات')
                    ->schema([
                        Select::make('product_id')->label('محصول')->prefixIcon('fast-food')->prefixIconColor('icon')
                            ->relationship('product', 'title')->searchable()->preload()->live()->afterStateUpdated(function (Set $set, $state) {
                                if ($state) {
                                    $product = Product::find($state);
                                    if ($product->discount) {
                                        $set('price', number_format(makeDiscount($product->price, $product->discount)));
                                        $set('discount', $product->discount);
                                    } else {
                                        $set('price', number_format($product->price));
                                    }
                                } else {
                                    $set('price', null);
                                    $set('discount', null);
                                }
                            })->searchable()->preload()->disableOptionsWhenSelectedInSiblingRepeaterItems()->required(),
                        TextInput::make('price')->prefix('تومان')->label('قیمت')->live(true)->afterStateUpdated(function (Get $get, Set $set, $state) {
                                if ($get('product_id')) {
                                    // dd($state);
                                    $product = Product::find($get('product_id'));
                                    $set('discount', getDiscountPercentage($product->price, str_replace(',','',$state)));
                                }
                            })->required()->mask(RawJs::make('$money($input)'))->stripCharacters(','),
                        TextInput::make('count')->prefixIcon('count')->prefixIconColor('icon')->label('تعداد')->default(1)->numeric()->required(),
                        TextInput::make('discount')->prefixIconColor('icon')->prefixIcon('heroicon-c-receipt-percent')->label('درصد تخفیف')->default(0)->rules([
                                fn(): Closure => function (string $attribute, $value, Closure $fail) {
                                    if ($value < 0 || $value > 100) {
                                        $fail('مقدار :attribute باید بین 0 تا 100 باشد.');
                                    }
                                }
                            ])->required(),
                    ])->columns(4)->columnSpanFull(),

                // Forms\Components\TextInput::make('total_discount')
                //     ->required()
                //     ->numeric(),
                // Forms\Components\TextInput::make('total_amount')
                //     ->required()
                //     ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table->defaultSort('id','desc')
            ->columns([

                Tables\Columns\TextColumn::make('name')->label('نام')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')->label('شماره تلفن')
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.name')->label('کاربر')->default('ندارد')->badge()->color('a')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('table.title')->label('میز')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('order_date')->label('تاریخ سفارش')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('payment_date')->label('تاریخ پرداخت')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')->label('وضعیت')
                    ->searchable(),
                Tables\Columns\TextColumn::make('total_discount')->label('مجموع تخفیف')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total_amount')->label('مجموع قیمت')
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
                Tables\Actions\ViewAction::make(),
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

    public static function getNavigationBadge(): ?string
    {
        return Invoice::query()->where('status','pending')->count(); // TODO: Change the autogenerated stub
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
