<?php

namespace App\Filament\Resources\Astpp\CiSessionResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CiSessionTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('session_id')->label('Session ID')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('ip_address')->label('IP Address')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('user_agent')->label('User Agent')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('last_activity')->label('Last Activity')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('user_data')->label('User Data')->searchable()->sortable()->limit(40)->toggleable(),
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
