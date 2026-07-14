<?php

namespace App\Filament\Resources\FusionPBX\Dashboards\Tables;

use Filament\Support\Enums\FontFamily;
use Filament\Support\Enums\FontWeight;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class DashboardsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('dashboard_name')
                    ->label('Dashboard Name')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Medium),
                IconColumn::make('dashboard_label_enabled')
                    ->label('Dashboard Label Enabled')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                IconColumn::make('dashboard_enabled')
                    ->label('Dashboard Enabled')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                TextColumn::make('insert_date')
                    ->label('Insert Date')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->color('gray'),
                TextColumn::make('dashboard_uuid')
                    ->label('UUID')
                    ->fontFamily(null)
                    ->color('gray')
                    ->copyable()
                    ->copyMessage('UUID copied')
                    ->limit(20)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('dashboard_name')
            ->filters([
                TernaryFilter::make('dashboard_label_enabled')
                    ->label('Status')
                    ->trueLabel('Enabled only')
                    ->falseLabel('Disabled only'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
