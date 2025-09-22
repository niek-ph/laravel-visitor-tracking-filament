<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\VisitorEvents\Pages;

use Filament\Resources\Pages\ViewRecord;

class ViewEvent extends ViewRecord
{
    public static function getResource(): string
    {
        return config('visitor-tracking-filament.resources.VisitorEventResource');
    }

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
