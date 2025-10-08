<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use NiekPH\LaravelVisitorTracking\VisitorTracking;
use NiekPH\LaravelVisitorTrackingFilament\Facades\VisitorTrackingFilament;

class TopCountriesWidget extends Widget
{
    protected string $view = 'visitor-tracking-filament::widgets.top-countries-list';

    protected int|string|array $columnSpan = 'full';

    protected ?string $maxHeight = '400px';

    protected static ?int $sort = 5;

    public function getHeading(): string|Htmlable|null
    {
        return __('visitor-tracking-filament::widgets.top_countries_list.heading');
    }

    protected function getViewData(): array
    {
        return [
            'countries' => $this->getTopCountries(),
        ];
    }

    private function getTopCountries(): array
    {
        return app()->isLocal() ?
            $this->generateCountriesData()
            :
            Cache::remember('top-countries-list', 600, fn () => $this->generateCountriesData());
    }

    private function generateCountriesData(): array
    {
        $tableName = (new (VisitorTracking::$visitorModel))->getTable();

        // Get top 10 countries with visitor counts
        $topCountries = DB::table($tableName)
            ->select('geo_country', DB::raw('COUNT(*) as visitor_count'))
            ->whereNotNull('geo_country')
            ->where('geo_country', '!=', '')
            ->groupBy('geo_country')
            ->having('visitor_count', '>=', 1)
            ->orderBy('visitor_count', 'desc')
            ->limit(10)
            ->get();

        // Get total count for percentage calculation
        $totalCount = DB::table($tableName)
            ->whereNotNull('geo_country')
            ->where('geo_country', '!=', '')
            ->count();

        // Format the data
        return $topCountries->map(function ($country, $index) use ($totalCount) {
            $percentage = $totalCount > 0 ? round(($country->visitor_count / $totalCount) * 100, 1) : 0;

            return [
                'rank' => $index + 1,
                'country_code' => $country->geo_country,
                'country_name' => VisitorTrackingFilament::getCountryName($country->geo_country),
                'flag' => VisitorTrackingFilament::getCountryFlagEmoji($country->geo_country),
                'visitor_count' => (int) $country->visitor_count,
                'percentage' => $percentage,
            ];
        })->toArray();
    }
}
