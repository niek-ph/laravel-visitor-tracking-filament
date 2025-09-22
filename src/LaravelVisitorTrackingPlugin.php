<?php

namespace NiekPH\LaravelVisitorTrackingFilament;

use Filament\Contracts\Plugin;
use Filament\Panel;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\VisitorEvents\VisitorEventResource;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\VisitorResource;

class LaravelVisitorTrackingPlugin implements Plugin
{
    protected string $visitorResource = VisitorResource::class;

    protected string $visitorEventResource = VisitorEventResource::class;

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
                $this->visitorResource,
                $this->visitorEventResource,
            ])
            ->pages([

            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    public function useVisitorResource(string $visitorResource): static
    {
        $this->visitorResource = $visitorResource;

        return $this;
    }

    public function useVisitorEventResource(string $visitorEventResource): static
    {
        $this->visitorEventResource = $visitorEventResource;

        return $this;
    }

    public function getVisitorEventResource(): string
    {
        return $this->visitorEventResource;
    }

    public function getVisitorResource(): string
    {
        return $this->visitorResource;
    }
}
