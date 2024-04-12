<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsWidget extends BaseWidget
{
    use InteractsWithPageFilters;

    protected int | string | array $columnSpan = 1;

    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        $usersQuery = User::when(
            $startDate, fn ($query, $startDate) => $query->whereDate('created_at', '>=', $startDate)
        )->when(
            $endDate, fn ($query, $endDate) => $query->whereDate('created_at', '<=', $endDate)
        )->count();

        $categoriesQuery = Category::when(
            $startDate, fn ($query, $startDate) => $query->whereDate('created_at', '>=', $startDate)
        )->when(
            $endDate, fn ($query, $endDate) => $query->whereDate('created_at', '<=', $endDate)
        )->count();

        $postsQuery = Post::when(
            $startDate, fn ($query, $startDate) => $query->whereDate('created_at', '>=', $startDate)
        )->when(
            $endDate, fn ($query, $endDate) => $query->whereDate('created_at', '<=', $endDate)
        )->count();


        return [
            Stat::make('New Users', $usersQuery)
                ->description('Newly Joined Users')
                ->descriptionIcon('heroicon-s-user-group', IconPosition::Before)
                ->descriptionColor('success')
                ->chart([
                    1, 2, 3, 8, 32, 18, 40
                ])->color('success'),

            Stat::make('Categories', $categoriesQuery)
                ->description('Total Categories')
                ->descriptionIcon('heroicon-s-folder', IconPosition::Before)
                ->descriptionColor('success')
                ->chart([
                    2, 5, 8, 10, 20, 22, 25
                ])->color('success'),

            Stat::make('Posts', $postsQuery)
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
