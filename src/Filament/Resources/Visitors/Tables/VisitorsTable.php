<?php

namespace NiekPH\LaravelVisitorTrackingFilament\Filament\Resources\Visitors\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
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
                    ->placeholder('-'),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('visitor-tracking-filament::resources.visitors.table.columns.updated_at'))
                    ->placeholder('-'),
                TextColumn::make('ip_address')
                    ->searchable()
                    ->label(__('visitor-tracking-filament::resources.visitors.table.columns.ip_address'))
                    ->placeholder('-')
                    ->color('primary'),
                TextColumn::make('tag')
                    ->searchable()
                    ->label(__('visitor-tracking-filament::resources.visitors.table.columns.tag'))
                    ->placeholder('-'),
                TextColumn::make('user.name')
                    ->sortable()
                    ->label(__('visitor-tracking-filament::resources.visitors.table.columns.user'))
                    ->placeholder('-'),
                TextColumn::make('user_agent')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('is_bot')
                    ->boolean()
                    ->label(__('visitor-tracking-filament::resources.visitors.table.columns.is_bot'))
                    ->placeholder('-'),
                TextColumn::make('device')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->label(__('visitor-tracking-filament::resources.visitors.table.columns.device'))
                    ->placeholder('-'),
                TextColumn::make('browser')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('visitor-tracking-filament::resources.visitors.table.columns.browser'))
                    ->placeholder('-'),
                TextColumn::make('platform')
                    ->toggleable(isToggledHiddenByDefault: false)
                    ->label(__('visitor-tracking-filament::resources.visitors.table.columns.platform'))
                    ->placeholder('-'),
                TextColumn::make('platform_version')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label(__('visitor-tracking-filament::resources.visitors.table.columns.platform_version'))
                    ->placeholder('-'),

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
