<?php

namespace App\Filament\Resources\Astpp\OutboundRouteResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OutboundRouteTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('pattern')->label('Pattern')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('status')->label('Status')->badge()->sortable()->toggleable(),
                TextColumn::make('comment')->label('Comment')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('connectcost')->label('Connectcost')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('includedseconds')->label('Includedseconds')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('cost')->label('Cost')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('trunk.name')->label('Trunk ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('inc')->label('Inc')->searchable()->sortable()->limit(40)->toggleable(),
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
