<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\VisitorEvents\Pages;

use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\VisitorEvents\VisitorEventResource;
use Filament\Resources\Pages\ViewRecord;

class ViewEvent extends ViewRecord
{
    protected static string $resource = VisitorEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
