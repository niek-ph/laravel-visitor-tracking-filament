<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\Pages;

use Filament\Resources\Pages\ListRecords;
use Filament\Support\Enums\Width;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\RecentVisitorsStatWidget;

class ListVisitors extends ListRecords
{
    protected Width|string|null $maxContentWidth = 'full';

    public static function getResource(): string
    {
        return config('visitor-tracking-filament.resources.VisitorResource');
    }

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            RecentVisitorsStatWidget::class,
            //            RecentVisitorsChartWidget::class,
            //            EventsByTypeChartWidget::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [

        ];
    }
}
