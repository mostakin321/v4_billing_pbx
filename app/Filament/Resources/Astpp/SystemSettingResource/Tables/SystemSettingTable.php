<?php

namespace App\Filament\Resources\Astpp\SystemSettingResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SystemSettingTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('name')->label('Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('display_name')->label('Display Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('value')->label('Value')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('field_type')->label('Field Type')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('comment')->label('Comment')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('timestamp')->label('Timestamp')->dateTime()->sortable()->toggleable(),
                TextColumn::make('is_display')->label('Is Display')->badge()->sortable()->toggleable(),
                TextColumn::make('group_title')->label('Group Title')->searchable()->sortable()->limit(40)->toggleable(),
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
