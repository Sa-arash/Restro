<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\OrderChart;
use App\Filament\Widgets\OrdersSales;
use App\Filament\Widgets\reportOrder;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Pages\Dashboard\Concerns\HasFiltersForm;

class Dashboard extends \Filament\Pages\Dashboard
{
    use HasFiltersForm;

    public function filtersForm(Form $form)
    {
        return $form
            ->schema([
                Select::make('date')->label('بازه زمانی')->options([
                    '0d' => 'امروز',
                    '1d' => 'دیروز ',
                    '0w' => 'این هفته ',
                    '1w' => 'هفته گذشته ',
                    '0m' => 'این ماه ',
                    '1m' => 'ماه گذشته',
                    '0y' => 'امسال',
                    '1y' => 'سال گذشته',
                ])
            ])->columns(1);
    }
}
