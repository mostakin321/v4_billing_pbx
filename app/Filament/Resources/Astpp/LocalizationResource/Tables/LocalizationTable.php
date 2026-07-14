<?php

namespace App\Filament\Resources\Astpp\LocalizationResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LocalizationTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('name')->label('Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('account.number')->label('Account ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('status')->label('Status')->badge()->sortable()->toggleable(),
                TextColumn::make('country.country')->label('Country ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('in_caller_id_originate')->label('In Caller ID Originate')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('out_caller_id_originate')->label('Out Caller ID Originate')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('number_originate')->label('Number Originate')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('in_caller_id_terminate')->label('In Caller ID Terminate')->searchable()->sortable()->limit(40)->toggleable(),
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
