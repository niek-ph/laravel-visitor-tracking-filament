<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class VisitorsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('visitor-tracking-filament::resources.visitors.table.columns.created_at'))
                    ->placeholder('-')
                    ->toggleable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->label(__('visitor-tracking-filament::resources.visitors.table.columns.updated_at'))
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('ip_address')
                    ->searchable()
                    ->label(__('visitor-tracking-filament::resources.visitors.table.columns.ip_address'))
                    ->placeholder('-')
                    ->color('primary')
                    ->toggleable(),
                TextColumn::make('tag')
                    ->searchable()
                    ->label(__('visitor-tracking-filament::resources.visitors.table.columns.tag'))
                    ->placeholder('-')
                    ->toggleable(),
                TextColumn::make('user.name')
                    ->sortable()
                    ->label(__('visitor-tracking-filament::resources.visitors.table.columns.user'))
                    ->placeholder('-')
                    ->toggleable(),
                TextColumn::make('user_agent')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_bot')
                    ->boolean()
                    ->label(__('visitor-tracking-filament::resources.visitors.table.columns.is_bot'))
                    ->placeholder('-')
                    ->toggleable(),
                TextColumn::make('device')
                    ->label(__('visitor-tracking-filament::resources.visitors.table.columns.device'))
                    ->placeholder('-')
                    ->toggleable(),
                TextColumn::make('browser')
                    ->label(__('visitor-tracking-filament::resources.visitors.table.columns.browser'))
                    ->placeholder('-')
                    ->toggleable(),
                TextColumn::make('platform')
                    ->label(__('visitor-tracking-filament::resources.visitors.table.columns.platform'))
                    ->placeholder('-')
                    ->toggleable(),
                TextColumn::make('platform_version')
                    ->label(__('visitor-tracking-filament::resources.visitors.table.columns.platform_version'))
                    ->placeholder('-')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                TernaryFilter::make('is_bot')
                    ->label(__('visitor-tracking-filament::resources.visitors.table.columns.is_bot')),
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
