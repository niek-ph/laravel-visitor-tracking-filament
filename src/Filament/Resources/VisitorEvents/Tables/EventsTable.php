<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\VisitorEvents\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\VisitorResource;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('visitor-tracking-filament::resources.visitor_events.table.columns.created_at'))
                    ->placeholder('-')
                    ->toggleable(),
                TextColumn::make('visitor.ip_address')
                    ->url(fn ($record): string => isset($record->visitor_id) ? VisitorResource::getUrl('view',
                        ['record' => $record->visitor_id]) : '')
                    ->color('primary')
                    ->sortable()
                    ->searchable()
                    ->label(__('visitor-tracking-filament::resources.visitor_events.table.columns.ip_address'))
                    ->toggleable(),
                TextColumn::make('name')
                    ->badge()
                    ->sortable()
                    ->label(__('visitor-tracking-filament::resources.visitor_events.table.columns.name'))
                    ->toggleable(),
                TextColumn::make('url')
                    ->label(__('visitor-tracking-filament::resources.visitor_events.table.columns.url'))
                    ->toggleable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
