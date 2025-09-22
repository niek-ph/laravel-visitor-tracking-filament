<?php

namespace NiekPH\LaravelVisitorTrackingFilament;

use Filament\Contracts\Plugin;
use Filament\Panel;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\VisitorEvents\VisitorEventResource;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\VisitorResource;

class LaravelVisitorTrackingPlugin implements Plugin
{
    public static function make(): static
    {
        return app(static::class);
    }

    public function getId(): string
    {
        return 'laravel-visitor-tracking';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->resources([
                VisitorResource::class,
                VisitorEventResource::class,
            ])
            ->pages([

            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
