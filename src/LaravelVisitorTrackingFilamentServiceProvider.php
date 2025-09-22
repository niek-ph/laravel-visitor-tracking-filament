<?php

namespace NiekPH\LaravelVisitorTrackingFilament;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelVisitorTrackingFilamentServiceProvider extends PackageServiceProvider
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
}
