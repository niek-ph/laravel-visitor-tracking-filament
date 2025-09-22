<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\Pages;

use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\VisitorResource;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\RecentVisitorsChartWidget;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\VisitorCountTodayWidget;

class ListVisitors extends ListRecords
{
    protected static string $resource = VisitorResource::class;

    protected Width|string|null $maxContentWidth = 'full';

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getHeaderWidgets(): array
    {
        return [
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            VisitorCountTodayWidget::class,
            RecentVisitorsChartWidget::class,
        ];
    }
}
