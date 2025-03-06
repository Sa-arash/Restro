<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum InvoiceStatus:string implements HasColor,HasLabel
{

case Payed = 'payed';
case Order = 'order';
case Pending = 'pending';
case Canceled = 'cancele';

    public function getLabel(): ?string
    {
        return match ($this){
            self::Payed => 'پرداخت شده',
            self::Order => 'سفارش داده شده',
            self::Pending => 'در حال انتظار',
            self::Canceled => 'لغو شده',
        };
    }
    public function getColor(): string|array|null
    {
        return match($this){
            self::Payed => 'success',
            self::Order => 'warning',
            self::Pending => 'info',
            self::Canceled => 'danger',

        };
    }
}
