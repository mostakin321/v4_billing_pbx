<?php

namespace App\Filament\Resources\FusionPBX\DialplanDetails\Tables;

use Filament\Support\Enums\FontFamily;
use Filament\Support\Enums\FontWeight;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class DialplanDetailsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Order badge
                TextColumn::make('dialplan_detail_order')
                    ->label('#')
                    ->sortable()
                    ->alignCenter()
                    ->badge()
                    ->color('gray')
                    ->width('60px'),

                // Tag: condition / action / antiaction
                TextColumn::make('dialplan_detail_tag')
                    ->label('Tag')
                    ->badge()
                    ->color(fn(?string $state) => match($state) {
                        'condition'  => 'info',
                        'action'     => 'success',
                        'antiaction' => 'warning',
                        default      => 'gray',
                    })
                    ->sortable(),

                // Type (field or app name)
                TextColumn::make('dialplan_detail_type')
                    ->label('Type / Field')
                    ->searchable()
                    ->fontFamily(FontFamily::Mono)
                    ->weight(FontWeight::Medium)
                    ->limit(40),

                // Data (value or regex)
                TextColumn::make('dialplan_detail_data')
                    ->label('Data / Value')
                    ->searchable()
                    ->fontFamily(FontFamily::Mono)
                    ->color('gray')
                    ->limit(50)
                    ->tooltip(fn($record) => $record?->dialplan_detail_data),

                // Inline flag
                TextColumn::make('dialplan_detail_inline')
                    ->label('Inline')
                    ->badge()
                    ->color(fn(?string $state) => $state === 'true' ? 'warning' : 'gray')
                    ->formatStateUsing(fn(?string $state) => $state === 'true' ? 'inline' : '—')
                    ->toggleable(isToggledHiddenByDefault: false),

                // Enabled
                TextColumn::make('dialplan_detail_enabled')
                    ->label('Status')
                    ->badge()
                    ->color(fn($state) => $state === true || $state === 'true' ? 'success' : 'danger')
                    ->formatStateUsing(fn($state) => $state === true || $state === 'true' ? 'Enabled' : 'Disabled'),

                // UUID hidden by default
                TextColumn::make('dialplan_detail_uuid')
                    ->label('UUID')
                    ->fontFamily(FontFamily::Mono)
                    ->color('gray')
                    ->copyable()
                    ->limit(20)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('dialplan_detail_order')
            ->filters([
                SelectFilter::make('dialplan_detail_tag')
                    ->label('Tag')
                    ->options([
                        'condition'  => 'Condition',
                        'action'     => 'Action',
                        'antiaction' => 'Anti-action',
                    ]),
                TernaryFilter::make('dialplan_detail_enabled')
                    ->label('Status')
                    ->trueLabel('Enabled only')
                    ->falseLabel('Disabled only'),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ])
            ->emptyStateIcon('heroicon-o-code-bracket-square')
            ->emptyStateHeading('No Dialplan Details')
            ->emptyStateDescription('Add conditions and actions to build this dialplan.');
    }
}
