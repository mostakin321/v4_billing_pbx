<?php

namespace App\Filament\Resources\Astpp\CliGroupResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CliGroupTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('name')->label('Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('status')->label('Status')->badge()->sortable()->toggleable(),
                TextColumn::make('description')->label('Description')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('mapping_expired_by')->label('Mapping Expired By')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('mapping_expired_after')->label('Mapping Expired After')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('assignment_method')->label('Assignment Method')->badge()->sortable()->toggleable(),
                TextColumn::make('creation_date')->label('Creation Date')->dateTime()->sortable()->toggleable(),
                TextColumn::make('last_access_date')->label('Last Access Date')->dateTime()->sortable()->toggleable(),
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
