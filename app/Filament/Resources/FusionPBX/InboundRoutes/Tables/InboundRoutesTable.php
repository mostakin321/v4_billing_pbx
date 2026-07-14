<?php

namespace App\Filament\Resources\FusionPBX\InboundRoutes\Tables;

use Filament\Support\Enums\FontFamily;
use Filament\Support\Enums\FontWeight;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class InboundRoutesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('destination_number')
                    ->label('DID Number')->searchable()->sortable()
                    ->weight(FontWeight::Bold)->icon('heroicon-m-arrow-down-on-square'),
                TextColumn::make('destination_app')
                    ->label('Application')->placeholder('—')->searchable(),
                TextColumn::make('destination_data')
                    ->label('Destination')->placeholder('—')->searchable()->limit(40),
                TextColumn::make('destination_context')
                    ->label('Context')->placeholder('—')->badge()->color('gray'),
                TextColumn::make('destination_enabled')
                    ->label('Status')->badge()
                    ->color(fn(?string $s) => $s === 'true' ? 'success' : 'danger')
                    ->formatStateUsing(fn(?string $s) => $s === 'true' ? 'Enabled' : 'Disabled'),
                TextColumn::make('insert_date')
                    ->label('Created')->dateTime('M j, Y')->sortable()->color('gray')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('destination_uuid')
                    ->label('UUID')->fontFamily(null)->color('gray')
                    ->copyable()->limit(20)->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('destination_number')
            ->filters([
                SelectFilter::make('destination_enabled')->label('Status')
                    ->options(['true' => 'Enabled', 'false' => 'Disabled']),
            ])
            ->actions([EditAction::make(), DeleteAction::make()])
            ->bulkActions([BulkActionGroup::make([DeleteBulkAction::make()])])
            ->emptyStateIcon('heroicon-o-arrow-down-on-square')
            ->emptyStateHeading('No Inbound Routes')
            ->emptyStateDescription('Add a DID number to route incoming calls.');
    }
}
