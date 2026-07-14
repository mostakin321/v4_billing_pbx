<?php

namespace App\Filament\Resources\Astpp\UserlevelResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UserlevelTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('userlevelid')->label('Userlevelid')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('userlevelname')->label('Userlevelname')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('module_permissions')->label('Module Permissions')->searchable()->sortable()->limit(40)->toggleable(),
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
