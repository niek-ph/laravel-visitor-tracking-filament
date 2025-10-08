<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;
use NiekPH\LaravelVisitorTracking\VisitorTracking;

class TotalVisitorsStatWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        $data = $this->getData();

        return [
            Stat::make(__('visitor-tracking-filament::widgets.total_visitors_stat.total_visitors'),
                $this->formatNumber($data['total_visitors'])),

            Stat::make(__('visitor-tracking-filament::widgets.total_visitors_stat.total_users'),
                $this->formatNumber($data['total_users'])),

            Stat::make(__('visitor-tracking-filament::widgets.total_visitors_stat.total_bots'),
                $this->formatNumber($data['total_bots'])),

            Stat::make(__('visitor-tracking-filament::widgets.total_visitors_stat.total_events'),
                $this->formatNumber($data['total_events'])),
        ];
    }

    private function formatNumber(int $number): string
    {
        return Number::forHumans($number, 2, 2, true);
    }

    private function getData(): array
    {
        return [
            'total_visitors' => VisitorTracking::$visitorModel::count(),
            'total_users' => VisitorTracking::$visitorModel::where('is_bot', false)->count(),
            'total_bots' => VisitorTracking::$visitorModel::where('is_bot', true)->count(),
            'total_events' => VisitorTracking::$eventModel::count(),
        ];
    }
}
