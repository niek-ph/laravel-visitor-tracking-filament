<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets;

use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Schemas\Schema;
use Filament\Support\Facades\FilamentIcon;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\ChartWidget;
use Filament\Widgets\View\WidgetsIconAlias;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use NiekPH\LaravelVisitorTracking\VisitorTracking;

class RecentVisitorsChart extends ChartWidget
{
    use ChartWidget\Concerns\HasFiltersSchema;

    public function getHeading(): string|Htmlable|null
    {
        return __('visitor-tracking-filament::widgets.recent_visitors.heading');
    }

    protected int|string|array $columnSpan = 'full';

    protected ?string $maxHeight = '300px';

    protected static ?int $sort = 1;

    public function getDescription(): string|Htmlable|null
    {
        $startDate = isset($this->filters['startDate']) ? Carbon::parse($this->filters['startDate']) : $this->getDefaultStartDate();
        $endDate = isset($this->filters['endDate']) ? Carbon::parse($this->filters['endDate']) : now();

        return __('visitor-tracking-filament::widgets.recent_visitors.description',
            ['start' => $startDate->toDateTimeString(), 'end' => $endDate->toDateTimeString()]);
    }

    public function getFiltersTriggerAction(): Action
    {
        return Action::make('filter')
            ->label(__('filament-widgets::chart.actions.filter.label'))
            ->icon(FilamentIcon::resolve(WidgetsIconAlias::CHART_WIDGET_FILTER) ?? Heroicon::Funnel)
            ->color('gray')
            ->button()
            ->livewireClickHandlerEnabled(false);
    }

    public function filtersSchema(Schema $schema): Schema
    {
        return $schema->components([
            DateTimePicker::make('startDate')
                ->default($this->getDefaultStartDate()),
            DateTimePicker::make('endDate')
                ->default(null),
        ]);
    }

    private function getDefaultStartDate(): Carbon
    {
        return now()->subDays(30);
    }

    protected function getData(): array
    {
        $startDate = isset($this->filters['startDate']) ? Carbon::parse($this->filters['startDate']) : null;
        $endDate = isset($this->filters['endDate']) ? Carbon::parse($this->filters['endDate']) : null;

        // Use caching to avoid repeated expensive queries
        return app()->isLocal() ?
            $this->generateChartData($startDate, $endDate)
            :
            Cache::remember('recent-visitors-chart', 300, fn() => $this->generateChartData($startDate, $endDate));
    }

    private function generateChartData(?Carbon $start = null, ?Carbon $end = null): array
    {
        // Single optimized query to get visitor counts grouped by date
        $visitorCounts = VisitorTracking::$visitorModel::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where(function ($subQuery) use ($end, $start) {
                if (isset($start)) {
                    $subQuery->where('created_at', '>=', $start);
                }
                if (isset($end)) {
                    $subQuery->where('created_at', '<=', $end);
                }
            })
            ->groupBy(DB::raw('DATE(created_at)'))
            ->pluck('count', 'date')
            ->toArray();

        $data = [];
        $labels = [];

        // Generate data for each day, filling in zeros for missing days
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dateString = $date->toDateString();

            $labels[] = $date->format('M j');
            $data[] = $visitorCounts[$dateString] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => __('visitor-tracking-filament::widgets.recent_visitors.label'),
                    'data' => $data,
                    'borderColor' => 'rgb(59, 130, 246)',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'fill' => true,
                    'tension' => 0.2,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ],
        ];
    }
}
