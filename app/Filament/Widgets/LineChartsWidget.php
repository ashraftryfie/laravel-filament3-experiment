<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class LineChartsWidget extends ChartWidget
{
    protected static ?string $heading = 'Post Chart';

    protected int | string | array $columnSpan = 1;

    protected static ?int $sort = 2;

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
        $data = Trend::model(User::class)
            ->between(
                start: now()->subMonths(10),  // last 6 months
                end: now(),
            )
            ->perMonth()
            ->count();

        //dd($data); // testing data

        return [
            'datasets' => [
                [
                    'label' => 'Newly joined users',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
