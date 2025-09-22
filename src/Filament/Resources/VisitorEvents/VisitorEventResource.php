<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\VisitorEvents;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\VisitorEvents\Pages\ListEvents;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\VisitorEvents\Pages\ViewEvent;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\VisitorEvents\Schemas\EventInfolist;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\VisitorEvents\Tables\EventsTable;

class VisitorEventResource extends Resource
{
    public static function getModel(): string
    {
        return config('visitor-tracking.models.visitor_event');
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static bool $shouldRegisterNavigation = false;

    public static function getNavigationGroup(): string|\UnitEnum|null
    {
        return __('visitor-tracking-filament::resources.visitor_events.navigation_group');
    }

    public static function getLabel(): ?string
    {
        return __('visitor-tracking-filament::resources.visitor_events.label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('visitor-tracking-filament::resources.visitor_events.plural_label');
    }

    public static function infolist(Schema $schema): Schema
    {
        return EventInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EventsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEvents::route('/'),
            'view' => ViewEvent::route('/{record}'),
        ];
    }
}
