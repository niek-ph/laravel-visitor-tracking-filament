<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use NiekPH\LaravelVisitorTracking\VisitorTracking;

class Events30DChartWidget extends ChartWidget
{
    use ChartWidget\Concerns\HasFiltersSchema;

    public function getHeading(): string|Htmlable|null
    {
        return __('visitor-tracking-filament::widgets.events_30d_chart.heading');
    }

    protected int|string|array $columnSpan = 'full';

    protected ?string $maxHeight = '500px';

    protected static ?int $sort = 2;

    protected function getData(): array
    {
        return app()->isLocal() ?
            $this->generateChartData()
            :
            Cache::remember('events-by-type-chart', 600, fn () => $this->generateChartData());
    }

    private function generateChartData(): array
    {
        $start = now()->subDays(30);
        // Get event counts grouped by name
        $eventCounts = VisitorTracking::$eventModel::select('name', DB::raw('COUNT(*) as count'))
            ->where('created_at', '>=', $start)
            ->groupBy('name')
            ->orderBy('count', 'desc')
            ->limit(10) // Limit to top 10 event types for better readability
            ->pluck('count', 'name')
            ->toArray();

        $labels = array_keys($eventCounts);
        $data = array_values($eventCounts);

        // Generate colors for each bar
        $colors = $this->generateColors(count($labels));

        return [
            'datasets' => [
                [
                    'label' => __('visitor-tracking-filament::widgets.events_30d_chart.label'),
                    'data' => $data,
                    'backgroundColor' => $colors['background'],
                    'borderColor' => $colors['border'],
                    'borderWidth' => 1,
                ],
            ],
            'labels' => Arr::map($labels, fn ($label) => $label.' ('.$eventCounts[$label].')'),
        ];
    }

    private function generateColors(int $count): array
    {
        $baseColors = [
            ['bg' => 'rgba(59, 130, 246, 0.8)', 'border' => 'rgb(59, 130, 246)'], // Blue
            ['bg' => 'rgba(16, 185, 129, 0.8)', 'border' => 'rgb(16, 185, 129)'], // Green
            ['bg' => 'rgba(245, 158, 11, 0.8)', 'border' => 'rgb(245, 158, 11)'], // Yellow
            ['bg' => 'rgba(239, 68, 68, 0.8)', 'border' => 'rgb(239, 68, 68)'], // Red
            ['bg' => 'rgba(139, 92, 246, 0.8)', 'border' => 'rgb(139, 92, 246)'], // Purple
            ['bg' => 'rgba(236, 72, 153, 0.8)', 'border' => 'rgb(236, 72, 153)'], // Pink
            ['bg' => 'rgba(14, 165, 233, 0.8)', 'border' => 'rgb(14, 165, 233)'], // Sky
            ['bg' => 'rgba(34, 197, 94, 0.8)', 'border' => 'rgb(34, 197, 94)'], // Emerald
            ['bg' => 'rgba(251, 146, 60, 0.8)', 'border' => 'rgb(251, 146, 60)'], // Orange
            ['bg' => 'rgba(168, 85, 247, 0.8)', 'border' => 'rgb(168, 85, 247)'], // Violet
        ];

        $backgrounds = [];
        $borders = [];

        for ($i = 0; $i < $count; $i++) {
            $color = $baseColors[$i % count($baseColors)];
            $backgrounds[] = $color['bg'];
            $borders[] = $color['border'];
        }

        return [
            'background' => $backgrounds,
            'border' => $borders,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false, // Hide legend for bar chart with single dataset
                ],
            ],
            'scales' => [
                'x' => [
                    'ticks' => [
                        'maxRotation' => 0,
                        'minRotation' => 0,
                    ],
                ],
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'precision' => 0,
                    ],
                ],
            ],
            'responsive' => true,
            'maintainAspectRatio' => false,
        ];
    }
}
