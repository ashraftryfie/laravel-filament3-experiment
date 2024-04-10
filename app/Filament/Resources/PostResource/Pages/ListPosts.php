<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array {
        return [
            'All' => Tab::make(),
            'Pending' => Tab::make()->modifyQueryUsing(function (Builder $query) {
                return $query->where('status', 'pending');
            }),
            'Published' => Tab::make()->modifyQueryUsing(function (Builder $query) {
                return $query->where('status', 'published');
            }),
            'Blocked' => Tab::make()->modifyQueryUsing(function (Builder $query) {
                return $query->where('status', 'blocked');
            }),
        ];
    }

}
