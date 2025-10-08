<?php

namespace NiekPH\LaravelVisitorTrackingFilament;

use Filament\Support\Assets\Css;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class VisitorTrackingFilamentServiceProvider extends PackageServiceProvider
{
    public static string $name = 'laravel-visitor-tracking-filament';

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name(static::$name)
            ->hasConfigFile()
            ->hasViews()
            ->hasTranslations();
    }

    public function packageBooted(): void
    {
        FilamentAsset::register(
            assets: [
                Css::make('styles', __DIR__.'/../resources/dist/styles.css')->loadedOnRequest(),
            ],
            package: 'laravel-visitor-tracking-filament/styles'
        );
    }
}
