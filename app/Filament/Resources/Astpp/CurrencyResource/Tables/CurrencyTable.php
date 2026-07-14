<?php

namespace App\Filament\Resources\Astpp\CurrencyResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CurrencyTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('currency')->label('Currency')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('currencyname')->label('Currencyname')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('currencyrate')->label('Currencyrate')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('last_updated')->label('Last Updated')->dateTime()->sortable()->toggleable(),
                TextColumn::make('is_supported')->label('Is Supported')->badge()->sortable()->toggleable(),
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
