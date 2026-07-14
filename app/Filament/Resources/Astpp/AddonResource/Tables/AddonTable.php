<?php

namespace App\Filament\Resources\Astpp\AddonResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AddonTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('package_name')->label('Package Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('version')->label('Version')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('installed_date')->label('Installed Date')->dateTime()->sortable()->toggleable(),
                TextColumn::make('last_updated_date')->label('Last Updated Date')->dateTime()->sortable()->toggleable(),
                TextColumn::make('files')->label('Files')->searchable()->sortable()->limit(40)->toggleable(),
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
