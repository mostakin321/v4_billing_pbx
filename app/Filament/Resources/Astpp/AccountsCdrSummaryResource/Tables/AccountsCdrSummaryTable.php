<?php

namespace App\Filament\Resources\Astpp\AccountsCdrSummaryResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AccountsCdrSummaryTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('date_hour')->label('Date Hour')->dateTime()->sortable()->toggleable(),
                TextColumn::make('account.number')->label('Account ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('country.country')->label('Country ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('account_entity_id')->label('Account Entity ID')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('total_calls')->label('Total Calls')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('answered_calls')->label('Answered Calls')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('minutes')->label('Minutes')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('debit')->label('Debit')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('cost')->label('Cost')->searchable()->sortable()->limit(40)->toggleable(),
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
