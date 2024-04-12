<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\Concerns\InteractsWithPageFilters;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsWidget extends BaseWidget
{
    use InteractsWithPageFilters;

    protected function getStats(): array
    {
        $startDate = $this->filters['startDate'] ?? null;
        $endDate = $this->filters['endDate'] ?? null;

        $usersQuery = User::when(
            $startDate, fn($query, $startDate) => $query->whereDate('created_at', '>=', $startDate)
        )->when(
            $endDate, fn($query, $endDate) => $query->whereDate('created_at', '<=', $endDate)
        )->count();


        return [
            Stat::make('New Users', $usersQuery)
                ->description('Newly Joined Users')
                ->descriptionIcon('heroicon-s-user-group', IconPosition::Before)
                ->descriptionColor('success')
                ->chart([
                    1, 2, 3, 8, 32, 18, 40
                ])->color('success'),
        ];
    }
}
