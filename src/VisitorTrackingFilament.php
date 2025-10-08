<?php

namespace NiekPH\LaravelVisitorTrackingFilament;

use NiekPH\LaravelVisitorTracking\Models\Visitor;

class VisitorTrackingFilament
{
    /**
     * Get a unicode country flag based on a 2 letter country code.
     */
    public function getCountryFlagEmoji(?string $code = null): ?string
    {
        if (empty($code)) {
            return null;
        }

        $code = strtoupper($code);

        if (! isset($code[0]) || ! isset($code[1])) {
            return null;
        }

        $first = mb_ord($code[0]) - 65 + 0x1F1E6;
        $second = mb_ord($code[1]) - 65 + 0x1F1E6;

        return mb_chr($first).mb_chr($second);
    }

    /**
     * Get the translated country code
     */
    public function getCountryName(?string $countryCode = null): ?string
    {
        if (empty($countryCode)) {
            return null;
        }

        return __("visitor-tracking-filament::countries.$countryCode");
    }

    /**
     * Get a google maps url based on the latitude and longitude attributes of the visitor model.
     */
    public function getGoogleMapsUrl(Visitor $record): ?string
    {
        if (! isset($record->geo_latitude) || ! isset($record->geo_longitude)) {
            return null;
        }

        return "https://www.google.com/maps/place/{$record->geo_latitude},{$record->geo_longitude}";
    }

    /**
     * Get a string containing the coordinates based on the latitude and longitude attributes of the visitor model.
     */
    public function getCoordinates(Visitor $record): ?string
    {
        if (! isset($record->geo_latitude) || ! isset($record->geo_longitude)) {
            return null;
        }

        return number_format($record->geo_latitude, 6).', '.number_format($record->geo_longitude, 6);
    }
}
