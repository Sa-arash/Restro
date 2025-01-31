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
            self::Free => 'استفاده نشده',
            self::Use => ' استفاده شده',
        };
    }
    public function getColor(): string|array|null
    {
        return match($this){
            self::Free => 'danger',
            self::Use => 'success',

        };
    }
}
