<?php

namespace App\Filament\Resources\Astpp\AccountResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AccountTable
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
                TextColumn::make('status')->label('Status')->badge()->sortable()->toggleable(),
                TextColumn::make('deleted')->label('Deleted')->badge()->sortable()->toggleable(),
                TextColumn::make('creation')->label('Creation')->dateTime()->sortable()->toggleable(),
                TextColumn::make('pricelist.name')->label('Pricelist ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('paypal_permission')->label('Paypal Permission')->badge()->sortable()->toggleable(),
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
