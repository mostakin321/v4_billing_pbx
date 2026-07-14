<?php

namespace App\Filament\Resources\Astpp\OrderItemResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrderItemTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('order.order_id')->label('Order ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('account.number')->label('Accountid')->searchable()->sortable()->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('product_category')->label('Product Category')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('product.name')->label('Product ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('quantity')->label('Quantity')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('price')->label('Price')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('setup_fee')->label('Setup Fee')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('billing_type')->label('Billing Type')->searchable()->sortable()->limit(40)->toggleable(),
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
