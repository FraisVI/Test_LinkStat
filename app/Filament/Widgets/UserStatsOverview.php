<?php

namespace App\Filament\Widgets;

use App\Models\ShortLink;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class UserStatsOverview extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $linksQuery = ShortLink::query()
            ->where('user_id', auth()->id());

        $linksCount = (clone $linksQuery)->count();
        $clicksCount = (clone $linksQuery)->withCount('clicks')->get()->sum('clicks_count');

        return [
            Stat::make('Ссылки', $linksCount),
            Stat::make('Клики', $clicksCount),
        ];
    }
}
