<?php

namespace App\Providers;

use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Tables\Table;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Table::$defaultDateDisplayFormat = 'Y/m/d';
        Table::$defaultDateTimeDisplayFormat = ' H:i - Y/m/d ';
        Infolist::$defaultDateDisplayFormat = 'Y/m/d';
        Infolist::$defaultDateTimeDisplayFormat = 'H:i- Y/m/d';

    }
}
