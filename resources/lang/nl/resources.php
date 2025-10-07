<?php

return [
    'visitors' => [
        'navigation_group' => 'Analytics',
        'label' => 'Bezoeker',
        'plural_label' => 'Bezoekers',
        'table' => [
            'columns' => [
                'created_at' => 'Eerste bezoek',
                'updated_at' => 'Laatste wijziging',
                'ip_address' => 'IP adres',
                'tag' => 'Unieke tag',
                'user' => 'Gebruiker',
                'device' => 'Apparaat',
                'platform_version' => 'Platform versie',
                'is_bot' => 'Bot',
                'browser' => 'Browser',
                'platform' => 'Platform',
                'geo_country' => 'Land',
                'geo_region' => 'Regio',
                'geo_city' => 'Stad',
            ],
            'filters' => [
                'is_bot' => [
                    'placeholder' => 'Alle bezoekers',
                    'true_label' => 'Alleen bots',
                    'false_label' => 'Alleen echte bezoekers',
                    'label' => 'Bots',
                ],
            ],
        ],
        'infolist' => [
            'sections' => [
                'geolocation' => 'Locatie',
                'details' => 'Details',
            ],
            'fields' => [
                'tag' => 'Unieke tag',
                'ip_address' => 'IP adres',
                'user_agent' => 'User Agent',
                'is_bot' => 'Bot',
                'device' => 'Apparaat',
                'browser' => 'Browser',
                'platform' => 'Platform',
                'platform_version' => 'Platform versie',
                'user' => 'Gebruiker',
                'geo_country' => 'Land',
                'geo_region' => 'Regio',
                'geo_city' => 'Stad',
                'geo_latitude' => 'Breedtegraad',
                'geo_longitude' => 'Lengtegraad',
                'coordinates' => 'Coördinaten',
                'google_maps' => 'Google maps',
            ],
        ],
    ],
    'visitor_events' => [
        'navigation_group' => 'Analytics',
        'label' => 'Gebeurtenis',
        'plural_label' => 'Gebeurtenissen',
        'table' => [
            'columns' => [
                'created_at' => 'Gemeten op',
                'name' => 'Naam',
                'url' => 'URL',
                'ip_address' => 'IP adres',
            ],
        ],
        'infolist' => [
            'fields' => [
                'visitor' => 'Bezoeker',
                'name' => 'Naam',
                'url' => 'URL',
                'created_at' => 'Gemeten op',
                'data' => 'Data',
            ],
        ],
    ],
];
