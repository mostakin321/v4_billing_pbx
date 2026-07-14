<?php

namespace App\Filament\Resources\FusionPBX\OutboundRoutes\Tables;

use Filament\Support\Enums\FontFamily;
use Filament\Support\Enums\FontWeight;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class OutboundRoutesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('dialplan_name')
                    ->label('Route Name')
                    ->searchable()->sortable()
                    ->weight(FontWeight::Bold)
                    ->icon('heroicon-m-arrow-up-on-square')
                    ->description(fn($r) => $r?->dialplan_description ?? null),

                TextColumn::make('dialplan_context')
                    ->label('Domain / Context')
                    ->badge()->color('gray')
                    ->searchable(),

                TextColumn::make('dialplan_order')
                    ->label('Order')
                    ->sortable()
                    ->alignCenter(),

                TextColumn::make('dialplan_enabled')
                    ->label('Status')
                    ->badge()
                    ->color(fn(?string $s) => $s === 'true' ? 'success' : 'danger')
                    ->formatStateUsing(fn(?string $s) => $s === 'true' ? 'Enabled' : 'Disabled'),

                TextColumn::make('insert_date')
                    ->label('Created')
                    ->dateTime('M j, Y')
                    ->sortable()->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('dialplan_uuid')
                    ->label('UUID')
                    ->fontFamily(FontFamily::Mono)->color('gray')
                    ->copyable()->limit(20)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('dialplan_order')
            ->filters([
                SelectFilter::make('dialplan_enabled')
                    ->label('Status')
                    ->options(['true' => 'Enabled', 'false' => 'Disabled']),
                SelectFilter::make('dialplan_context')
                    ->label('Domain')
                    ->options(function () {
                        try {
                            return \App\Models\FusionPBX\Domain::where('domain_enabled', true)
                                ->pluck('domain_name', 'domain_name')->toArray();
                        } catch (\Exception $e) {
                            return [];
                        }
                    }),
            ])
            ->actions([
                ActionGroup::make([
                    EditAction::make(),
                    DeleteAction::make(),
                ]),
            ])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])])
            ->emptyStateIcon('heroicon-o-arrow-up-on-square')
            ->emptyStateHeading('No Outbound Routes')
            ->emptyStateDescription('Click "New Outbound Route" to create routes by selecting a gateway and number patterns.');
    }
}
