<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Number;
use NiekPH\LaravelVisitorTracking\VisitorTracking;

class VisitorCountTodayWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 0;

    protected function getStats(): array
    {
        $data = $this->getData();

        return [
            Stat::make(__('visitor-tracking-filament::widgets.visitor_counts.visitors_total'),
                $this->formatNumber($data['visitors_total'])),
            Stat::make(__('visitor-tracking-filament::widgets.visitor_counts.visitors_today'),
                $this->formatNumber($data['visitors_today'])),
            Stat::make(__('visitor-tracking-filament::widgets.visitor_counts.page_views_today'),
                $this->formatNumber($data['page_views_today'])),
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
            'visitors_total' => VisitorTracking::$visitorModel::count(),
            'visitors_today' => VisitorTracking::$visitorModel::whereHas(
                'events',
                fn ($q) => $q->whereDate('created_at', $today)
            )->count(),
            'page_views_today' => VisitorTracking::$eventModel::where('name', 'page_view')
                ->whereDate('created_at', $today)
                ->count(),
        ];
    }
}
