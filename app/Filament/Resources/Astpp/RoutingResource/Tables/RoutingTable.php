<?php

namespace App\Filament\Resources\Astpp\RoutingResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RoutingTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('pricelist.name')->label('Pricelist ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('trunk.name')->label('Trunk ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('route.pattern')->label('Routes ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('percentage')->label('Percentage')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('call_count')->label('Call Count')->searchable()->sortable()->limit(40)->toggleable(),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
