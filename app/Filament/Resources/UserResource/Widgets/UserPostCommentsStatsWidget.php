<?php

namespace App\Filament\Resources\UserResource\Widgets;

use App\Models\User;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserPostCommentsStatsWidget extends BaseWidget
{
    public ?User $record;

    protected function getStats(): array
    {
        return [
            Stat::make('User Posts', $this->record->posts()->count())
                ->description('Total Posts')
                ->descriptionIcon('heroicon-s-pencil-square', IconPosition::Before)
                ->descriptionColor('success')
                ->chart([
                    0
                ])->color('success'),

            Stat::make('User Comments', $this->record->comments()->count())
                ->description('Total Categories')
                ->descriptionIcon('heroicon-s-folder', IconPosition::Before)
                ->descriptionColor('success')
                ->chart([
                    2, 5, 8, 10, 20, 22, 25
                ])->color('success'),
        ];
    }
}
