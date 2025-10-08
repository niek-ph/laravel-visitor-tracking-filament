<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Pages;

use Filament\Pages\Page;
use Filament\Support\Enums\Width;
use Filament\Support\Icons\Heroicon;
use Illuminate\Contracts\Support\Htmlable;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\TopCountriesWidget;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\TopDevicesPieChartWidget;

class AnalyticsPage extends Page
{
    protected string $view = 'visitor-tracking-filament::pages.analytics';

    protected static string|\BackedEnum|null $navigationIcon = Heroicon::ChartBar;

    public static function getNavigationLabel(): string
    {
        return __('visitor-tracking-filament::pages.analytics.navigation_label');
    }

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return __('visitor-tracking-filament::pages.analytics.navigation_group');
    }

    public function getTitle(): string|Htmlable
    {
        return __('visitor-tracking-filament::pages.analytics.label');
    }

    public static function getLabel(): ?string
    {
        return __('visitor-tracking-filament::pages.analytics.label');
    }

    public function getMaxContentWidth(): Width
    {
        return Width::Full;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            //            VisitorCountTodayWidget::class,
            //            RecentVisitorsChartWidget::class,
            //            EventsByTypeChartWidget::class,
            //            TopDevicesPieChartWidget::class,
            //            TopCountriesWidget::class,
        ];
    }
}
