<?php

namespace NiekPH\LaravelVisitorTrackingFilament;

use Filament\Contracts\Plugin;
use Filament\Panel;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Pages\AnalyticsPage;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\Events30DChartWidget;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\RecentVisitorsStatWidget;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\TopBrowsersPieChartWidget;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\TopCountriesWidget;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\TopDevicesPieChartWidget;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\TotalVisitorsStatWidget;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\Visitors30DChartWidget;

class VisitorTrackingFilamentPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'laravel-visitor-tracking';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources(config('visitor-tracking-filament.resources'))
            ->pages([AnalyticsPage::class])
            ->widgets([
                Events30DChartWidget::class,
                Visitors30DChartWidget::class,
                RecentVisitorsStatWidget::class,
                TopDevicesPieChartWidget::class,
                TopCountriesWidget::class,
                TopBrowsersPieChartWidget::class,
                TotalVisitorsStatWidget::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
