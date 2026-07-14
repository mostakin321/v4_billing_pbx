<?php

namespace App\Filament\Resources\Astpp\SipProfileResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SipProfileTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('name')->label('Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('account.number')->label('Accountid')->searchable()->sortable()->toggleable(),
                TextColumn::make('status')->label('Status')->badge()->sortable()->toggleable(),
                TextColumn::make('created_date')->label('Created Date')->dateTime()->sortable()->toggleable(),
                TextColumn::make('sip_ip')->label('SIP IP')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('sip_port')->label('SIP Port')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('profile_data')->label('Profile Data')->searchable()->sortable()->limit(40)->toggleable(),
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
