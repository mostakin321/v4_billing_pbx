<?php

namespace App\Filament\Resources\Astpp\CdrResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CdrTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('pattern')->label('Pattern')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('account.number')->label('Accountid')->searchable()->sortable()->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('provider.number')->label('Provider ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('uniqueid')->label('Uniqueid')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('type')->label('Type')->badge()->sortable()->toggleable(),
                TextColumn::make('sip_user')->label('SIP User')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('callerid')->label('Callerid')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('callednum')->label('Callednum')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('translated_dst')->label('Translated Dst')->searchable()->sortable()->limit(40)->toggleable(),
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
