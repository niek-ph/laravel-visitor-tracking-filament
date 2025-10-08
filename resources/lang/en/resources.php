<?php

return [
    'visitors' => [
        'navigation_group' => 'Analytics',
        'label' => 'Visitor',
        'plural_label' => 'Visitors',
        'table' => [
            'columns' => [
                'created_at' => 'First visit',
                'updated_at' => 'Last updated',
                'ip_address' => 'IP address',
                'tag' => 'Unique tag',
                'user' => 'User',
                'device' => 'Device',
                'platform_version' => 'Platform version',
                'is_bot' => 'Bot',
                'browser' => 'Browser',
                'platform' => 'Platform',
                'geo_country' => 'Country',
                'geo_region' => 'Region',
                'geo_city' => 'City',
            ],
            'filters' => [
                'is_bot' => [
                    'placeholder' => 'All visitors',
                    'true_label' => 'Bot visitors',
                    'false_label' => 'Real visitors',
                    'label' => 'Bots',
                ],
                'geo_country' => [
                    'placeholder' => 'All countries',
                    'label' => 'Country',
                ],
            ],
        ],
        'infolist' => [
            'sections' => [
                'geolocation' => 'Geolocation',
                'details' => 'Details',
            ],
            'fields' => [
                'tag' => 'Unique tag',
                'ip_address' => 'IP address',
                'user_agent' => 'User Agent',
                'is_bot' => 'Bot',
                'device' => 'Device',
                'browser' => 'Browser',
                'platform' => 'Platform',
                'platform_version' => 'Platform version',
                'user' => 'User',
                'geo_country' => 'Country',
                'geo_region' => 'Region',
                'geo_city' => 'City',
                'geo_latitude' => 'Latitude',
                'geo_longitude' => 'Longitude',
                'coordinates' => 'Coordinates',
                'google_maps' => 'Google maps',
                'created_at' => 'First visit on',
            ],
        ],
    ],
    'visitor_events' => [
        'navigation_group' => 'Analytics',
        'label' => 'Event',
        'plural_label' => 'Events',
        'table' => [
            'columns' => [
                'created_at' => 'Created at',
                'name' => 'Name',
                'url' => 'URL',
                'ip_address' => 'IP address',
            ],
        ],
        'infolist' => [
            'fields' => [
                'visitor' => 'Visitor',
                'name' => 'Name',
                'url' => 'URL',
                'created_at' => 'Created at',
                'data' => 'Data',
            ],
        ],
    ],
];
