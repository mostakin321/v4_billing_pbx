<?php

namespace App\Filament\Resources\Astpp\TrunkResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TrunkTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('name')->label('Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('provider.number')->label('Provider ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('status')->label('Status')->badge()->sortable()->toggleable(),
                TextColumn::make('tech')->label('Tech')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('gateway.name')->label('Gateway ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('failoverGateway.name')->label('Failover Gateway ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('failoverGateway1.name')->label('Failover Gateway ID1')->searchable()->sortable()->toggleable(),
                TextColumn::make('dialed_modify')->label('Dialed Modify')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('resellers_id')->label('Resellers ID')->searchable()->sortable()->limit(40)->toggleable(),
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
