<?php

namespace App\Filament\Resources\Astpp\CommissionResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CommissionTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('order.order_id')->label('Order ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('account.number')->label('Accountid')->searchable()->sortable()->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('product.name')->label('Product ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('paymentTransaction.id')->label('Payment ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('amount')->label('Amount')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('commission')->label('Commission')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('commission_rate')->label('Commission Rate')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('commission_status')->label('Commission Status')->searchable()->sortable()->limit(40)->toggleable(),
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
