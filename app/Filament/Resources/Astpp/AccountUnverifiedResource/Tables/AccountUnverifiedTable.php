<?php

namespace App\Filament\Resources\Astpp\AccountUnverifiedResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AccountUnverifiedTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('number')->label('Number')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('company_name')->label('Company Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('email')->label('Email')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('telephone')->label('Telephone')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('password')->label('Password')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('first_name')->label('First Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('last_name')->label('Last Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('country.country')->label('Country ID')->searchable()->sortable()->toggleable(),
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
