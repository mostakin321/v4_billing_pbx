<?php

namespace App\Filament\Resources\Astpp\CounterResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CounterTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('account.number')->label('Accountid')->searchable()->sortable()->toggleable(),
                TextColumn::make('status')->label('Status')->badge()->sortable()->toggleable(),
                TextColumn::make('product.name')->label('Product ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('packageProduct.name')->label('Package ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('used_seconds')->label('Used Seconds')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('type')->label('Type')->badge()->sortable()->toggleable(),
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
