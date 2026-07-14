<?php

namespace App\Filament\Resources\Astpp\TimezoneResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TimezoneTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('timezone_name')->label('Timezone Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('gmttime')->label('Gmttime')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('gmtoffset')->label('Gmtoffset')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('timezone_digit')->label('Timezone Digit')->searchable()->sortable()->limit(40)->toggleable(),
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
