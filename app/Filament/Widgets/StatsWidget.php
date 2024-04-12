<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsWidget extends BaseWidget
{
    protected int | string | array $columnSpan = 1;

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('New Users', User::count())
                ->description('Newly Joined Users')
                ->descriptionIcon('heroicon-s-user-group', IconPosition::Before)
                ->descriptionColor('success')
                ->chart([
                    1, 2, 3, 8, 32, 18, 40
                ])->color('success'),

            Stat::make('Categories', Category::count())
                ->description('Total Categories')
                ->descriptionIcon('heroicon-s-folder', IconPosition::Before)
                ->descriptionColor('success')
                ->chart([
                    2, 5, 8, 10, 20, 22, 25
                ])->color('success'),

            Stat::make('Posts', Post::count())
                ->description('Total Posts')
                ->descriptionIcon('heroicon-s-pencil-square', IconPosition::Before)
                ->descriptionColor('success')
                ->chart([
                    0
                ])->color('success'),

            // NOTE: We can add any other stats chart here too...
        ];
    }
}
