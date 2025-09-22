<?php

namespace NiekPH\LaravelVisitorTrackingFilament;

use Filament\Contracts\Plugin;
use Filament\Panel;

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
            ->resources(config('visitor-tracking-filament.resources'));
        //            ->pages([])
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
