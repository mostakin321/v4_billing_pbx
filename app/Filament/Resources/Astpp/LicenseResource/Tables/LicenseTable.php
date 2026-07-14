<?php

namespace App\Filament\Resources\Astpp\LicenseResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LicenseTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('created_date')->label('Created Date')->dateTime()->sortable()->toggleable(),
                TextColumn::make('license_key')->label('License Key')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('localkey')->label('Localkey')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('last_updated_date')->label('Last Updated Date')->dateTime()->sortable()->toggleable(),
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
