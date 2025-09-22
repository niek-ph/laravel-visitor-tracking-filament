<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\Pages;

use Filament\Resources\Pages\ViewRecord;

class ViewVisitor extends ViewRecord
{
    public static function getResource(): string
    {
        return config('visitor-tracking-filament.resources.VisitorResource');
    }

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
