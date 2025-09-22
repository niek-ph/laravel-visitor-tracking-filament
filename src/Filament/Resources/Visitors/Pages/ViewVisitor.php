<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\Pages;

use Filament\Resources\Pages\ViewRecord;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\VisitorResource;

class ViewVisitor extends ViewRecord
{
    protected static string $resource = VisitorResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
