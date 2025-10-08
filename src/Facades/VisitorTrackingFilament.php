<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \NiekPH\LaravelVisitorTrackingFilament\VisitorTrackingFilament
 */
class VisitorTrackingFilament extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \NiekPH\LaravelVisitorTrackingFilament\VisitorTrackingFilament::class;
    }
}
