<?php

namespace App\Filament\Resources\FusionPBX\DeviceVendorFunctionGroups\Tables;

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

class DeviceVendorFunctionGroupsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('insert_date')
                    ->label('Insert Date')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Medium),
                TextColumn::make('device_vendor_function_group_uuid')
                    ->label('UUID')
                    ->fontFamily(null)
                    ->color('gray')
                    ->copyable()
                    ->copyMessage('UUID copied')
                    ->limit(20)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('insert_date')
            ->filters([

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
