<?php

namespace App\Filament\Resources\Astpp\PaymentTransactionResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PaymentTransactionTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('account.number')->label('Accountid')->searchable()->sortable()->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('date')->label('Date')->dateTime()->sortable()->toggleable(),
                TextColumn::make('amount')->label('Amount')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('tax')->label('Tax')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('payment_method')->label('Payment Method')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('actual_amount')->label('Actual Amount')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('payment_fee')->label('Payment Fee')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('transaction_id')->label('Transaction ID')->searchable()->sortable()->limit(40)->toggleable(),
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
