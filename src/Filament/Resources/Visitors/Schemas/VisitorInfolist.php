<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use NiekPH\LaravelVisitorTracking\Models\Visitor;
use NiekPH\LaravelVisitorTrackingFilament\Facades\VisitorTrackingFilament;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Components\CountryEntry;

class VisitorInfolist
{
    public static function configure(Schema $schema): Schema
    {
        /** @var Model $model */
        $model = $schema->model;

        return $schema
            ->components([
                Grid::make()
                    ->columnSpanFull()
                    ->schema([
                        TextEntry::make('tag')
                            ->label(__('visitor-tracking-filament::resources.visitors.infolist.fields.tag'))
                            ->placeholder('-')
                            ->badge()
                            ->copyable()
                            ->copyMessageDuration(1500),
                        IconEntry::make('is_bot')
                            ->boolean()
                            ->label(__('visitor-tracking-filament::resources.visitors.infolist.fields.is_bot'))
                            ->placeholder('-')
                            ->hidden(! $model->getAttribute('is_bot')),
                    ]),

                TextEntry::make('user.name')
                    ->label(__('visitor-tracking-filament::resources.visitors.infolist.fields.user'))
                    ->placeholder('-')
                    ->hidden(is_null($model->getAttribute('user_id')))
                    ->columnSpanFull(),

                Section::make(__('visitor-tracking-filament::resources.visitors.infolist.sections.details'))
                    ->id('section-details')
                    ->schema([
                        TextEntry::make('ip_address')
                            ->label(__('visitor-tracking-filament::resources.visitors.infolist.fields.ip_address'))
                            ->placeholder('-')
                            ->color('primary')
                            ->copyable()
                            ->copyMessageDuration(1500),
                        TextEntry::make('user_agent')
                            ->label(__('visitor-tracking-filament::resources.visitors.infolist.fields.user_agent'))
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
                    ])
                    ->columns(2),

                Section::make(__('visitor-tracking-filament::resources.visitors.infolist.sections.geolocation'))
                    ->id('section-geolocation')
                    ->schema([
                        CountryEntry::make('geo_country')
                            ->label(__('visitor-tracking-filament::resources.visitors.infolist.fields.geo_country'))
                            ->placeholder('-'),
                        TextEntry::make('geo_region')
                            ->label(__('visitor-tracking-filament::resources.visitors.infolist.fields.geo_region'))
                            ->placeholder('-'),
                        TextEntry::make('geo_city')
                            ->label(__('visitor-tracking-filament::resources.visitors.infolist.fields.geo_city'))
                            ->placeholder('-'),
                        TextEntry::make('coordinates')
                            ->label(__('visitor-tracking-filament::resources.visitors.infolist.fields.coordinates'))
                            ->placeholder('-')
                            ->state(fn (Visitor $record) => VisitorTrackingFilament::getCoordinates($record)),
                        TextEntry::make('maps_url')
                            ->label(__('visitor-tracking-filament::resources.visitors.infolist.fields.google_maps'))
                            ->placeholder('-')
                            ->state(fn (Visitor $record) => VisitorTrackingFilament::getGoogleMapsUrl($record))
                            ->url(fn (Visitor $record) => VisitorTrackingFilament::getGoogleMapsUrl($record))
                            ->openUrlInNewTab()
                            ->color('primary')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                TextEntry::make('created_at')
                    ->label(__('visitor-tracking-filament::resources.visitors.infolist.fields.created_at'))
                    ->placeholder('-')
                    ->columnSpanFull(),
            ]);
    }
}
