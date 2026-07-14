<?php

namespace App\Filament\Resources\Astpp\MenuModuleResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MenuModuleTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('module_name')->label('Module Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('menu_label')->label('Menu Label')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('module_url')->label('Module Url')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('menu_title')->label('Menu Title')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('menu_image')->label('Menu Image')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('menu_subtitle')->label('Menu Subtitle')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('priority')->label('Priority')->searchable()->sortable()->limit(40)->toggleable(),
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
