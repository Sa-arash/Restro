<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use App\Models\User;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Carbon;
use Hekmatinasser\Verta\Verta;

class StatsOverview extends BaseWidget
{
    use HasWidgetShield;
    use InteractsWithPageFilters;
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $filters = $this->filters['date'] ?? '0d';

        $where = [Verta::today()->startHour()->toCarbon(), Verta::today()->endDay()->toCarbon()];

        switch ($filters) {
            case '0d': // امروز
                $where = [Verta::today()->startHour()->toCarbon(), Verta::today()->endDay()->toCarbon()];
                break;
            case '1d': // دیروز
                $where = [Verta::yesterday()->startHour()->toCarbon(), Verta::yesterday()->endDay()->toCarbon()];
                break;
            case '0w': // این هفته
                $where = [Verta::now()->startWeek()->toCarbon(), Verta::now()->endWeek()->toCarbon()];
                break;
            case '1w': // هفته گذشته
                $where = [Verta::now()->subWeek()->startWeek()->toCarbon(), Verta::now()->subWeek()->endWeek()->toCarbon()];
                break;
            case '0m': // این ماه
                $where = [Verta::now()->startMonth()->toCarbon(), Verta::now()->endMonth()->toCarbon()];
                break;
            case '1m': // ماه گذشته
                $where = [Verta::now()->subMonth()->startMonth()->toCarbon(), Verta::now()->subMonth()->endMonth()->toCarbon()];
                break;
            case '0y': // امسال
                $where = [Verta::now()->startYear()->toCarbon(), Verta::now()->endYear()->toCarbon()];
                break;
            case '1y': // سال گذشته
                $where = [Verta::now()->subYear()->startYear()->toCarbon(), Verta::now()->subYear()->endYear()->toCarbon()];
                break;
        }

        $orders = Invoice::query()->where('status', 'payed')->whereBetween('created_at', $where)->get();
        $countSubmit = $orders->count();
        $totalSell = $orders->sum('total_amount');
        $countUsers = User::whereBetween('created_at', $where)->count();

        return [
            Stat::make('سفارشات', number_format($countSubmit)),
            Stat::make('فروش', number_format($totalSell) . ' تومان'),
            Stat::make('کاربران', number_format($countUsers)),
        ];
    }
}
