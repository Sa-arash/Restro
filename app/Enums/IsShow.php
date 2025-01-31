<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum IsShow:string implements HasColor,HasLabel
{

    case True = '1';
    case False = '0';

    public function getLabel(): ?string
    {
        return match ($this){
            self::True => 'تایید شده ',
            self::False => 'تایید نشده ',
        };
    }
    public function getColor(): string|array|null
    {
        return match($this){
            self::True => 'success',
            self::False => 'danger',
        };
    }
}
