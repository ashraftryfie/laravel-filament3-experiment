<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class LineChartsWidget extends ChartWidget
{
    use InteractsWithPageFilters;

    protected static ?string $heading = 'Post Chart';
    protected static ?int $sort = 2;
    protected int|string|array $columnSpan = 1;

    protected function getData(): array
    {
//        return [
//            'datasets' => [
//                [
//                    'label' => 'Blog posts created',
//                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 89],
//                    'backgroundColor' => '#36A2EB',
//                    'borderColor' => '#9BD0F5',
//                ],
//            ],
//            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
//        ];

        $startDate = $this->filters['startDate'] ?? 1;
        $endDate = $this->filters['endDate'] ?? 1;

        $data = Trend::model(User::class)
            ->between(
            //start: now()->subMonths(10),  // last 6 months
                start: $startDate ? Carbon::parse($startDate) : now()->subMonths(10),
                end: $endDate ? Carbon::parse($endDate) : now(),
            )
            ->perMonth()
            ->count();

        //dd($data); // testing data

        return [
            'datasets' => [
                [
                    'label' => 'Newly joined users',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
