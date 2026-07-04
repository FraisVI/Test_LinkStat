<?php

namespace App\Filament\Widgets;

use App\Models\ShortLinkClick;
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
        $clicksCount = ShortLinkClick::query()
            ->whereHas('shortLink', fn ($query) => $query->where('user_id', auth()->id()))
            ->count();

        return [
            Stat::make('Ссылки', $linksCount),
            Stat::make('Клики', $clicksCount),
        ];
    }
}
