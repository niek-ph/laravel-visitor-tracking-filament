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
                Number::forHumans($data['visitors_total'], 2, 2, true)),
            Stat::make(__('visitor-tracking-filament::widgets.visitor_counts.visitors_today'),
                Number::forHumans($data['visitors_today'], 2, 2, true)),
            Stat::make(__('visitor-tracking-filament::widgets.visitor_counts.page_views_today'),
                Number::forHumans($data['page_views_today'], 2, 2, true)),
        ];
    }

    private function getData(): array
    {
        return [
            'visitors_total' => VisitorTracking::$visitorModel::count(),
            'visitors_today' => VisitorTracking::$visitorModel::whereHas('events', function ($q) {
                $q->whereDate('created_at', today());
            })->count(),
            'page_views_today' => VisitorTracking::$eventModel::where('name', 'page_view')->whereDate('created_at',
                today())->count(),
        ];
    }
}
