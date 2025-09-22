<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\VisitorEvents\Pages;

use Filament\Resources\Pages\ListRecords;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\VisitorEvents\VisitorEventResource;

class ListEvents extends ListRecords
{
    protected static string $resource = VisitorEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
