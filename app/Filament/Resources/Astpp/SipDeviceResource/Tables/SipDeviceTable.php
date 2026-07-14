<?php

namespace App\Filament\Resources\Astpp\SipDeviceResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SipDeviceTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('username')->label('Username')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('account.number')->label('Accountid')->searchable()->sortable()->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('status')->label('Status')->badge()->sortable()->toggleable(),
                TextColumn::make('sipProfile.name')->label('SIP Profile ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('dir_params')->label('Dir Params')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('dir_vars')->label('Dir Vars')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('codec')->label('Codec')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('creation_date')->label('Creation Date')->dateTime()->sortable()->toggleable(),
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
