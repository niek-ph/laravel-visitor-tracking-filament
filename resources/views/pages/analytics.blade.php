<x-filament-panels::page>

    <div class="space-y-4">
        @livewire(\NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\RecentVisitorsStatWidget::class)
        @livewire(\NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\TotalVisitorsStatWidget::class)

        @livewire(\NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\Visitors30DChartWidget::class)

        @livewire(\NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\Events30DChartWidget::class)

        <div class="grid grid-cols-2 gap-4">
            <div>
                @livewire(\NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\TopDevicesPieChartWidget::class)
            </div>
            <div>
                @livewire(\NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\TopBrowsersPieChartWidget::class)
            </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                @livewire(\NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\TopCountriesWidget::class)
            </div>
        </div>


    </div>

</x-filament-panels::page>
