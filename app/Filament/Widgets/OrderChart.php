<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Hekmatinasser\Verta\Verta;

class OrderChart extends ChartWidget
{
    use InteractsWithPageFilters;
    use HasWidgetShield;
    protected int | string | array $columnSpan = 'full';

    protected static ?string $heading = 'نمودار سفارشات';
    protected static ?int $sort = 2;


    protected function getData(): array
    {
        $filter = $this->filters['date'] ?? '0d';

        switch ($filter) {
            case '1d': // دیروز
                $startDate = Verta::now()->subDay()->startDay()->toCarbon();
                $endDate = Verta::now()->subDay()->endDay()->toCarbon();
                break;
            case '0w': // این هفته
                $startDate = Verta::now()->startWeek()->toCarbon();
                $endDate = Verta::now()->endWeek()->toCarbon();
                break;
            case '1w': // هفته گذشته
                $startDate = Verta::now()->subWeek()->startWeek()->toCarbon();
                $endDate = Verta::now()->subWeek()->endWeek()->toCarbon();
                break;
            case '0m': // این ماه
                $startDate = Verta::now()->startMonth()->toCarbon();
                $endDate = Verta::now()->endMonth()->toCarbon();
                break;
            case '1m': // ماه گذشته
                $startDate = Verta::now()->subMonth()->startMonth()->toCarbon();
                $endDate = Verta::now()->subMonth()->endMonth()->toCarbon();
                break;
            case '0y': // امسال
                $startDate = Verta::now()->startYear()->toCarbon();
                $endDate = Verta::now()->endYear()->toCarbon();
                break;
            case '1y': // سال گذشته
                $startDate = Verta::now()->subYear()->startYear()->toCarbon();
                $endDate = Verta::now()->subYear()->endYear()->toCarbon();
                break;
            case '0d': // امروز
            default:
                $startDate = Verta::now()->startDay()->toCarbon();
                $endDate = Verta::now()->endDay()->toCarbon();
                break;
        }

        $orderCounts = [];
        $labels = [];

        $dateRange = $startDate->diffInDays($endDate) + 1;

        for ($i = 0; $i < $dateRange; $i++) {
            $currentDate = Verta::instance($startDate)->addDays($i);
            $startOfDay = $currentDate->startDay()->toCarbon();
            $endOfDay = $currentDate->endDay()->toCarbon();

            $count = Invoice::where('status', 'payed')
                ->whereBetween('created_at', [$startOfDay, $endOfDay])
                ->count();

            $orderCounts[] = $count;
            $labels[] = $currentDate->format('l'); // نمایش نام روز هفته
        }

        return [
            'datasets' => [
                [
                    'label' => 'تعداد سفارشات',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.6)',
                    'borderColor' => '#4BC0C0',
                    'data' => $orderCounts,
                ],
            ],
            'labels' => $labels,
        ];
    }


    protected function getType(): string
    {
        return 'bar';
    }
}
