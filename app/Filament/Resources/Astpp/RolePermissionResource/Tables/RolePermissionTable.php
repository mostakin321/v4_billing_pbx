<?php

namespace App\Filament\Resources\Astpp\RolePermissionResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RolePermissionTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('module_name')->label('Module Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('status')->label('Status')->badge()->sortable()->toggleable(),
                TextColumn::make('login_type')->label('Login Type')->badge()->sortable()->toggleable(),
                TextColumn::make('permission_type')->label('Permission Type')->badge()->sortable()->toggleable(),
                TextColumn::make('menu_name')->label('Menu Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('sub_module_name')->label('Sub Module Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('module_url')->label('Module Url')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('display_name')->label('Display Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('permissions')->label('Permissions')->searchable()->sortable()->limit(40)->toggleable(),
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
