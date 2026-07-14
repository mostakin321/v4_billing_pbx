<?php

namespace App\Filament\Resources\Astpp\FreeswichServerResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FreeswichServerTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('status')->label('Status')->badge()->sortable()->toggleable(),
                TextColumn::make('freeswitch_host')->label('Freeswitch Host')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('freeswitch_password')->label('Freeswitch Password')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('freeswitch_port')->label('Freeswitch Port')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('creation_date')->label('Creation Date')->dateTime()->sortable()->toggleable(),
                TextColumn::make('last_modified_date')->label('Last Modified Date')->dateTime()->sortable()->toggleable(),
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
