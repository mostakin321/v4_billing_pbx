<?php

namespace App\Filament\Resources\Astpp\InvoiceDetailResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InvoiceDetailTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('invoice.number')->label('Invoiceid')->searchable()->sortable()->toggleable(),
                TextColumn::make('account.number')->label('Accountid')->searchable()->sortable()->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('created_date')->label('Created Date')->dateTime()->sortable()->toggleable(),
                TextColumn::make('orderItem.order_id')->label('Order Item ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('charge_type')->label('Charge Type')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('paymentTransaction.id')->label('Payment ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('product_category')->label('Product Category')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('is_tax')->label('Is Tax')->badge()->sortable()->toggleable(),
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
