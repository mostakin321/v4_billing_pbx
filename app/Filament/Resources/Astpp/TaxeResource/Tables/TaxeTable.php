<?php

namespace App\Filament\Resources\Astpp\TaxeResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TaxeTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('status')->label('Status')->badge()->sortable()->toggleable(),
                TextColumn::make('taxes_priority')->label('Taxes Priority')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('taxes_amount')->label('Taxes Amount')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('tax_type')->label('Tax Type')->badge()->sortable()->toggleable(),
                TextColumn::make('taxes_rate')->label('Taxes Rate')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('taxes_description')->label('Taxes Description')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('last_modified_date')->label('Last Modified Date')->dateTime()->sortable()->toggleable(),
                TextColumn::make('creation_date')->label('Creation Date')->dateTime()->sortable()->toggleable(),
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
