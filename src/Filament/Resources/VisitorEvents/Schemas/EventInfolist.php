<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\VisitorEvents\Schemas;

use Filament\Infolists\Components\CodeEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Support\Colors\Color;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\VisitorResource;
use Phiki\Grammar\Grammar;

class EventInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('visitor.ip_address')
                    ->url(fn ($record): string => isset($record->visitor_id) ? VisitorResource::getUrl('view',
                        ['record' => $record->visitor_id]) : '')
                    ->color(Color::Blue)
                    ->label(__('visitor-tracking-filament::resources.visitor_events.infolist.fields.visitor')),
                TextEntry::make('name')
                    ->label(__('visitor-tracking-filament::resources.visitor_events.infolist.fields.name')),
                TextEntry::make('url')
                    ->label(__('visitor-tracking-filament::resources.visitor_events.infolist.fields.url')),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->label(__('visitor-tracking-filament::resources.visitor_events.infolist.fields.created_at')),
                CodeEntry::make('data')
                    ->grammar(Grammar::Json)
                    ->copyable()
                    ->columnSpanFull()
                    ->placeholder('-')
                    ->label(__('visitor-tracking-filament::resources.visitor_events.infolist.fields.data')),
            ]);
    }
}
