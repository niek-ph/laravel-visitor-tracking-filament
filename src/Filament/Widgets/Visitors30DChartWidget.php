<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use NiekPH\LaravelVisitorTracking\VisitorTracking;

class Visitors30DChartWidget extends ChartWidget
{
    //    use ChartWidget\Concerns\HasFiltersSchema;

    public function getHeading(): string|Htmlable|null
    {
        return __('visitor-tracking-filament::widgets.visitors_30d_chart.heading');
    }

    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 1;

    protected function getData(): array
    {
        // Use caching to avoid repeated expensive queries
        return app()->isLocal() ?
            $this->generateChartData()
            :
            Cache::remember('recent-visitors-chart', 300, fn () => $this->generateChartData());
    }

    private function generateChartData(): array
    {
        $start = now()->subDays(30);
        // Get total visitor counts grouped by date
        $totalVisitorCounts = VisitorTracking::$visitorModel::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where('created_at', '>=', $start)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->pluck('count', 'date')
            ->toArray();

        // Get real visitor counts (is_bot = false)
        $realVisitorCounts = VisitorTracking::$visitorModel::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where('is_bot', false)
            ->where('created_at', '>=', $start)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->pluck('count', 'date')
            ->toArray();

        // Get bot counts (is_bot = true)
        $botCounts = VisitorTracking::$visitorModel::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
            ->where('is_bot', true)
            ->where('created_at', '>=', $start)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->pluck('count', 'date')
            ->toArray();

        $totalData = [];
        $realData = [];
        $botData = [];
        $labels = [];

        // Generate data for each day, filling in zeros for missing days
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $dateString = $date->toDateString();

            $labels[] = $date->format('M j');
            $totalData[] = $totalVisitorCounts[$dateString] ?? 0;
            $realData[] = $realVisitorCounts[$dateString] ?? 0;
            $botData[] = $botCounts[$dateString] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => __('visitor-tracking-filament::widgets.visitors_30d_chart.labels.all'),
                    'data' => $totalData,
                    'fill' => true,
                    'tension' => 0.2,
                    'pointStyle' => 'circle',
                    'pointRadius' => 5,
                    'pointHoverRadius' => 10,

                ],
                [
                    'label' => __('visitor-tracking-filament::widgets.visitors_30d_chart.labels.users'),
                    'data' => $realData,
                    'fill' => false,
                    'tension' => 0.2,
                    'borderColor' => 'rgb(59, 130, 246)',
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'pointBackgroundColor' => 'rgb(59, 130, 246)',
                    'pointStyle' => 'circle',
                    'pointRadius' => 5,
                    'pointHoverRadius' => 10,

                ],
                [
                    'label' => __('visitor-tracking-filament::widgets.visitors_30d_chart.labels.bots'),
                    'data' => $botData,
                    'fill' => false,
                    'tension' => 0.2,
                    'borderColor' => 'rgb(239, 68, 68)',
                    'backgroundColor' => 'rgba(239, 68, 68, 0.1)',
                    'pointBackgroundColor' => 'rgb(239, 68, 68)',
                    'pointStyle' => 'circle',
                    'pointRadius' => 5,
                    'pointHoverRadius' => 10,

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
                    'position' => 'top',
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
