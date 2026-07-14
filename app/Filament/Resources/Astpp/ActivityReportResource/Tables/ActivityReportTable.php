<?php

namespace App\Filament\Resources\Astpp\ActivityReportResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ActivityReportTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('account.number')->label('Accountid')->searchable()->sortable()->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('last_did_call_time')->label('Last Did Call Time')->dateTime()->sortable()->toggleable(),
                TextColumn::make('last_outbound_call_time')->label('Last Outbound Call Time')->dateTime()->sortable()->toggleable(),
                TextColumn::make('balance')->label('Balance')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('credit_limit')->label('Credit Limit')->searchable()->sortable()->limit(40)->toggleable(),
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
