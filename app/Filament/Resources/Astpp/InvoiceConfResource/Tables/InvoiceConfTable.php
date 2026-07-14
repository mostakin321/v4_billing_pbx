<?php

namespace App\Filament\Resources\Astpp\InvoiceConfResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InvoiceConfTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('company_name')->label('Company Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('account.number')->label('Accountid')->searchable()->sortable()->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('address')->label('Address')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('city')->label('City')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('province')->label('Province')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('country')->label('Country')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('zipcode')->label('Zipcode')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('telephone')->label('Telephone')->searchable()->sortable()->limit(40)->toggleable(),
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
