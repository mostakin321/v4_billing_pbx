<?php

namespace App\Filament\Resources\Astpp\PermissionResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PermissionTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('name')->label('Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('description')->label('Description')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('login_type')->label('Login Type')->badge()->sortable()->toggleable(),
                TextColumn::make('permissions')->label('Permissions')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('edit_permissions')->label('Edit Permissions')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('creation_date')->label('Creation Date')->dateTime()->sortable()->toggleable(),
                TextColumn::make('modification_date')->label('Modification Date')->dateTime()->sortable()->toggleable(),
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
