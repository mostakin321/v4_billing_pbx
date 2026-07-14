<?php

namespace App\Filament\Resources\Astpp\PricelistResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PricelistTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('name')->label('Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('status')->label('Status')->badge()->sortable()->toggleable(),
                TextColumn::make('markup')->label('Markup')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('routing_type')->label('Routing Type')->badge()->sortable()->toggleable(),
                TextColumn::make('initially_increment')->label('Initially Increment')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('inc')->label('Inc')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('pricelist_id_admin')->label('Pricelist ID Admin')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('routing_prefix')->label('Routing Prefix')->searchable()->sortable()->limit(40)->toggleable(),
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
