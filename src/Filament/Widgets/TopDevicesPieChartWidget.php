<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Number;
use NiekPH\LaravelVisitorTracking\VisitorTracking;

class TopDevicesPieChartWidget extends ChartWidget
{
    public function getHeading(): string|Htmlable|null
    {
        return __('visitor-tracking-filament::widgets.top_devices_pie_chart.heading');
    }

    protected int|string|array $columnSpan = 'full';

    protected ?string $maxHeight = '400px';

    protected static ?int $sort = 3;

    protected function getData(): array
    {
        // Cache for 10 minutes to improve performance
        return app()->isLocal() ?
            $this->generateChartData()
            :
            Cache::remember('top-devices-pie-chart', 600, fn () => $this->generateChartData());
    }

    private function generateChartData(): array
    {
        // Get device counts grouped by device type
        $deviceCounts = VisitorTracking::$visitorModel::select('device', DB::raw('COUNT(*) as count'))
            ->whereNotNull('device')
            ->where('is_bot', false)
            ->where('device', '!=', '')
            ->groupBy('device')
            ->orderBy('count', 'desc')
            ->limit(8) // Limit to top 8 devices for better pie chart readability
            ->pluck('count', 'device')
            ->toArray();

        // If we have more than 8 devices, group the rest as "Others"
        $totalDevices = VisitorTracking::$visitorModel::whereNotNull('device')
            ->where('is_bot', false)
            ->where('device', '!=', '')
            ->count();

        $countedDevices = array_sum($deviceCounts);
        if ($totalDevices > $countedDevices) {
            $deviceCounts['Others'] = $totalDevices - $countedDevices;
        }

        // Calculate total for percentage calculations
        $total = array_sum($deviceCounts);

        // Create labels with count and percentage for legend
        $labels = [];
        $data = [];
        foreach ($deviceCounts as $device => $count) {
            $percentage = $total > 0 ? round(($count / $total) * 100, 1) : 0;
            $labels[] = ucfirst($device).' ('.Number::forHumans($count, 2, 2, true).' - '.$percentage.'%)';
            $data[] = $count;
        }

        $colors = $this->generatePieColors(count($labels));

        return [
            'datasets' => [
                [
                    'label' => __('visitor-tracking-filament::widgets.top_devices_pie_chart.label'),
                    'data' => $data,
                    'backgroundColor' => $colors,
                    'borderColor' => '#ffffff',
                    'borderWidth' => 1,
                    'hoverOffset' => 10,
                ],
            ],
            'labels' => $labels,
        ];
    }

    private function generatePieColors(int $count): array
    {
        $colors = [
            'rgba(59, 130, 246, 0.8)',   // Blue
            'rgba(16, 185, 129, 0.8)',   // Green
            'rgba(245, 158, 11, 0.8)',   // Yellow
            'rgba(239, 68, 68, 0.8)',    // Red
            'rgba(139, 92, 246, 0.8)',   // Purple
            'rgba(236, 72, 153, 0.8)',   // Pink
            'rgba(14, 165, 233, 0.8)',   // Sky
            'rgba(34, 197, 94, 0.8)',    // Emerald
            'rgba(251, 146, 60, 0.8)',   // Orange
            'rgba(168, 85, 247, 0.8)',   // Violet
        ];

        $result = [];
        for ($i = 0; $i < $count; $i++) {
            $result[] = $colors[$i % count($colors)];
        }

        return $result;
    }

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'right',
                    'labels' => [
                        'usePointStyle' => true,
                        'padding' => 20,
                        'font' => [
                            'size' => 12,
                        ],
                    ],
                ],
            ],
            'responsive' => true,
            'maintainAspectRatio' => true,
            'layout' => [
                'padding' => [
                    'top' => 5,
                    'bottom' => 5,
                    'left' => 10,
                    'right' => 10,
                ],
            ],
        ];
    }
}
