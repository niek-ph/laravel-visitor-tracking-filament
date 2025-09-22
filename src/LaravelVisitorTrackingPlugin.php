<?php

namespace NiekPH\LaravelVisitorTrackingFilament;

use Filament\Contracts\Plugin;
use Filament\Panel;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\VisitorEvents\VisitorEventResource;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\VisitorResource;

class LaravelVisitorTrackingPlugin implements Plugin
{
    public static string $visitorResource = VisitorResource::class;

    public static string $visitorEventResource = VisitorEventResource::class;

    public function useVisitorResource(string $visitorResource): static
    {
        static::$visitorResource = $visitorResource;

        return $this;
    }

    public function useVisitorEventResource(string $visitorEventResource): static
    {
        static::$visitorEventResource = $visitorEventResource;

        return $this;
    }

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
                static::$visitorResource,
                static::$visitorEventResource,
            ])
            ->pages([

            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }
}
