<?php

namespace App\Filament\Resources\Astpp\ProductResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProductTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('name')->label('Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('status')->label('Status')->badge()->sortable()->toggleable(),
                TextColumn::make('country.country')->label('Country ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('description')->label('Description')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('product_category')->label('Product Category')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('buy_cost')->label('Buy Cost')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('price')->label('Price')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('setup_fee')->label('Setup Fee')->searchable()->sortable()->limit(40)->toggleable(),
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
