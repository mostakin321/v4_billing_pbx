<?php

namespace App\Filament\Resources\Astpp\CountryCodeResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CountryCodeTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('country')->label('Country')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('currency.currency')->label('Currency ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('iso')->label('Iso')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('nicename')->label('Nicename')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('iso3')->label('Iso3')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('countrycode')->label('Countrycode')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('vat')->label('Vat')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('latitude')->label('Latitude')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('longitude')->label('Longitude')->searchable()->sortable()->limit(40)->toggleable(),
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
