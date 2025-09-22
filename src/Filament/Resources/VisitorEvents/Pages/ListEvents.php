<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\VisitorEvents\Pages;

use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\VisitorEvents\VisitorEventResource;
use Filament\Resources\Pages\ListRecords;

class ListEvents extends ListRecords
{
    protected static string $resource = VisitorEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
