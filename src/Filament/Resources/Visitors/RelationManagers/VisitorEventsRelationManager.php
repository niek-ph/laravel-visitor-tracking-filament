<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\RelationManagers;

use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\VisitorEvents\VisitorEventResource;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VisitorEventsRelationManager extends RelationManager
{
    protected static string $relationship = 'events';

    protected static ?string $relatedResource = VisitorEventResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('visitor-tracking-filament::resources.visitor_events.table.columns.created_at'))
                    ->placeholder('-'),
                TextColumn::make('name')
                    ->badge()
                    ->sortable()
                    ->label(__('visitor-tracking-filament::resources.visitor_events.table.columns.name'))
                ,
                TextColumn::make('url')
                    ->searchable()
                    ->label(__('visitor-tracking-filament::resources.visitor_events.table.columns.url')),
            ])
            ->defaultSort('created_at', 'desc')
            ->headerActions([
            ]);
    }
}
