<?php

namespace App\Filament\Resources\Astpp\LoginActivityReportResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LoginActivityReportTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('account.number')->label('Account ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('user_agent')->label('User Agent')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('country_name')->label('Country Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('ip')->label('IP')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('timestamp')->label('Timestamp')->dateTime()->sortable()->toggleable(),
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
