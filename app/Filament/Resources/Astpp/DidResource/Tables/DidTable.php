<?php

namespace App\Filament\Resources\Astpp\DidResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DidTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('number')->label('Number')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('account.number')->label('Accountid')->searchable()->sortable()->toggleable(),
                TextColumn::make('provider.number')->label('Provider ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('status')->label('Status')->badge()->sortable()->toggleable(),
                TextColumn::make('parent_id')->label('Parent ID')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('connectcost')->label('Connectcost')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('includedseconds')->label('Includedseconds')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('monthlycost')->label('Monthlycost')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('cost')->label('Cost')->searchable()->sortable()->limit(40)->toggleable(),
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
