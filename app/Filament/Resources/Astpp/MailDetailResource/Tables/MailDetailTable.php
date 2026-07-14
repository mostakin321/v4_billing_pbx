<?php

namespace App\Filament\Resources\Astpp\MailDetailResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MailDetailTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('subject')->label('Subject')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('account.number')->label('Accountid')->searchable()->sortable()->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('status')->label('Status')->badge()->sortable()->toggleable(),
                TextColumn::make('date')->label('Date')->dateTime()->sortable()->toggleable(),
                TextColumn::make('body')->label('Body')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('from')->label('From')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('to')->label('To')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('attachment')->label('Attachment')->searchable()->sortable()->limit(40)->toggleable(),
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
