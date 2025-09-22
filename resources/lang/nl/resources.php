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
            ],
        ],
        'infolist' => [
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
