<?php

namespace App\Filament\Resources\Astpp\UsertrackingResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsertrackingTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('session_id')->label('Session ID')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('user_identifier')->label('User IDentifier')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('request_uri')->label('Request Uri')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('timestamp')->label('Timestamp')->dateTime()->sortable()->toggleable(),
                TextColumn::make('client_ip')->label('Client IP')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('client_user_agent')->label('Client User Agent')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('referer_page')->label('Referer Page')->searchable()->sortable()->limit(40)->toggleable(),
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
