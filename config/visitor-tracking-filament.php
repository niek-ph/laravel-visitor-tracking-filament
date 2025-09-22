<?php

use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\VisitorEvents\VisitorEventResource;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\VisitorResource;

return [
    /**
     * You can optionally override the default resources provided by this package
     */
    'resources' => [
        'VisitorResource' => VisitorResource::class,
        'VisitorEventResource' => VisitorEventResource::class,
    ],
];
