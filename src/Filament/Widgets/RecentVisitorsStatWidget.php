<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;
use NiekPH\LaravelVisitorTracking\VisitorTracking;

class RecentVisitorsStatWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        $data = $this->getData();

        return [
            Stat::make(__('visitor-tracking-filament::widgets.recent_visitors_stat.visitors_today'),
                $this->formatNumber($data['visitors_today'])),

            Stat::make(__('visitor-tracking-filament::widgets.recent_visitors_stat.new_visitors_today'),
                $this->formatNumber($data['new_visitors_today'])),

            Stat::make(__('visitor-tracking-filament::widgets.recent_visitors_stat.events_today'),
                $this->formatNumber($data['events_today'])),
        ];
    }

    private function formatNumber(int $number): string
    {
        return Number::forHumans($number, 2, 2, true);
    }

    private function getData(): array
    {
        $today = today();

        return [
            'visitors_today' => VisitorTracking::$visitorModel::whereHas(
                'events',
                fn ($q) => $q->whereDate('created_at', $today)
            )->count(),
            'new_visitors_today' => VisitorTracking::$visitorModel::whereDate('created_at', $today)->count(),
            'events_today' => VisitorTracking::$eventModel::whereDate('created_at', $today)->count(),

        ];
    }
}
