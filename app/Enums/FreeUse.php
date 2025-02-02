<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum FreeUse:string implements HasColor,HasLabel
{

    case Free = 'free';
    case Use = 'use';

    public function getLabel(): ?string
    {
        return match ($this){
            self::Free => 'آزاد',
            self::Use => 'درحال استفاده',
        };
    }
    public function getColor(): string|array|null
    {
        return match($this){
            self::Free => 'success',
            self::Use => 'danger',

        };
    }
}
