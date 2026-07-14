<?php

namespace App\Filament\Resources\Astpp\TaxesToAccountResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TaxesToAccountTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('account.number')->label('Accountid')->searchable()->sortable()->toggleable(),
                TextColumn::make('tax.id')->label('Taxes ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('taxes_priority')->label('Taxes Priority')->badge()->sortable()->toggleable(),
                TextColumn::make('assign_date')->label('Assign Date')->dateTime()->sortable()->toggleable(),
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
