<?php

namespace App\Filament\Resources\Astpp\RefillCouponResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RefillCouponTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('number')->label('Number')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('account.number')->label('Account ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('status')->label('Status')->badge()->sortable()->toggleable(),
                TextColumn::make('amount')->label('Amount')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('description')->label('Description')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('firstused')->label('Firstused')->dateTime()->sortable()->toggleable(),
                TextColumn::make('currency.currency')->label('Currency ID')->searchable()->sortable()->toggleable(),
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
