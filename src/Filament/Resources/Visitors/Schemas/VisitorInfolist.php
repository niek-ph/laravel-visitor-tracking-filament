<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class VisitorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('tag')
                    ->label(__('visitor-tracking-filament::resources.visitors.infolist.fields.tag'))
                    ->placeholder('-'),
                TextEntry::make('ip_address')
                    ->label(__('visitor-tracking-filament::resources.visitors.infolist.fields.ip_address'))
                    ->placeholder('-'),
                TextEntry::make('user_agent')
                    ->label(__('visitor-tracking-filament::resources.visitors.infolist.fields.user_agent'))
                    ->placeholder('-'),
                IconEntry::make('is_bot')
                    ->boolean()
                    ->label(__('visitor-tracking-filament::resources.visitors.infolist.fields.is_bot'))
                    ->placeholder('-'),
                TextEntry::make('device')
                    ->label(__('visitor-tracking-filament::resources.visitors.infolist.fields.device'))
                    ->placeholder('-'),
                TextEntry::make('browser')
                    ->label(__('visitor-tracking-filament::resources.visitors.infolist.fields.browser'))
                    ->placeholder('-'),
                TextEntry::make('platform')
                    ->label(__('visitor-tracking-filament::resources.visitors.infolist.fields.platform'))
                    ->placeholder('-'),
                TextEntry::make('platform_version')
                    ->label(__('visitor-tracking-filament::resources.visitors.infolist.fields.platform_version'))
                    ->placeholder('-'),
                TextEntry::make('user.name')
                    ->label(__('visitor-tracking-filament::resources.visitors.infolist.fields.user'))
                    ->placeholder('-'),
            ]);
    }
}
