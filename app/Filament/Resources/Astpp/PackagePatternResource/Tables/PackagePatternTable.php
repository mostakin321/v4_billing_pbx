<?php

namespace App\Filament\Resources\Astpp\PackagePatternResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PackagePatternTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('destination')->label('Destination')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('product.name')->label('Product ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('country.country')->label('Country ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('patterns')->label('Patterns')->searchable()->sortable()->limit(40)->toggleable(),
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
