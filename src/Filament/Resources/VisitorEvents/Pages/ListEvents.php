<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\VisitorEvents\Pages;

use Filament\Resources\Pages\ListRecords;

class ListEvents extends ListRecords
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
