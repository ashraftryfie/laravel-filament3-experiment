<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class DoughnutChartsWidget extends ChartWidget
{
    protected static ?string $heading = 'Post Chart';

    protected int | string | array $columnSpan = '1';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => [45, 77, 89],
                    'backgroundColor' => [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => ['Mar',  'Jul', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
