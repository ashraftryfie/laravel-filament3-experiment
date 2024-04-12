<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UsersStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('New Users', User::count())
                ->description('Newly joined users')
                ->descriptionIcon('heroicon-s-user-group', IconPosition::Before)
                ->descriptionColor('success')
                ->chart([
                    1, 2, 3, 8, 32, 18, 40
                ])->color('success')
            ,
        ];
    }
}
