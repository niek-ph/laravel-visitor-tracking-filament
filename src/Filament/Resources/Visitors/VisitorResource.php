<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use NiekPH\LaravelVisitorTracking\VisitorTracking;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\Pages\ListVisitors;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\Pages\ViewVisitor;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\RelationManagers\VisitorEventsRelationManager;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\Schemas\VisitorInfolist;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\Tables\VisitorsTable;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\RecentVisitorsChart;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Widgets\VisitorCountTodayWidget;
use UnitEnum;

class VisitorResource extends Resource
{
    public static function getModel(): string
    {
        return VisitorTracking::$visitorModel;
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::UserCircle;

    protected static ?string $recordTitleAttribute = 'tag';

    public static function getNavigationGroup(): string|UnitEnum|null
    {
        return __('visitor-tracking-filament::resources.visitors.navigation_group');
    }

    public static function getLabel(): ?string
    {
        return __('visitor-tracking-filament::resources.visitors.label');
    }

    public static function getPluralLabel(): ?string
    {
        return __('visitor-tracking-filament::resources.visitors.plural_label');
    }

    public static function infolist(Schema $schema): Schema
    {
        return VisitorInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return VisitorsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            VisitorEventsRelationManager::make(),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            VisitorCountTodayWidget::class,
            RecentVisitorsChart::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVisitors::route('/'),
            'view' => ViewVisitor::route('/{record}'),
        ];
    }
}
