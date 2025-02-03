<?php

namespace App\Filament\Widgets;

use App\Models\Invoice;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Hekmatinasser\Verta\Verta;

class OrderChart extends ChartWidget
{
    use InteractsWithPageFilters;
    
    protected int | string | array $columnSpan='full';

    protected static ?string $heading = 'نمودار سفارشات';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $filters = $this->filters['date'] ?? '0d';

        $where = [Verta::now()->startWeek()->toCarbon(), Verta::now()->endWeek()->toCarbon()];

        switch ($filters) {
            case '0w': // این هفته
                $where = [Verta::now()->startWeek()->toCarbon(), Verta::now()->endWeek()->toCarbon()];
                break;
            case '1w': // هفته گذشته
                $where = [Verta::now()->subWeek()->startWeek()->toCarbon(), Verta::now()->subWeek()->endWeek()->toCarbon()];
                break;
        }

        $days = ['شنبه', 'یک‌شنبه', 'دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنج‌شنبه', 'جمعه'];
        $orderCounts = [];

        foreach (range(0, 6) as $day) {
            $startOfDay = Verta::now()->startWeek()->addDays($day)->startDay()->toCarbon();
            $endOfDay = Verta::now()->startWeek()->addDays($day)->endDay()->toCarbon();

            $count = Invoice::where('status', 'payed')
                ->whereBetween('created_at', [$startOfDay, $endOfDay])
                ->count();

            $orderCounts[] = $count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'تعداد سفارشات',
                    'backgroundColor' => 'rgba(75, 192, 192, 0.6)',
                    'data' => $orderCounts,
                ],
            ],
            'labels' => $days,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
