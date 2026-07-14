<?php

namespace App\Filament\Resources\Astpp\DefaultTemplateResource\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DefaultTemplateTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->label('Id')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('name')->label('Name')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('reseller.number')->label('Reseller ID')->searchable()->sortable()->toggleable(),
                TextColumn::make('status')->label('Status')->badge()->sortable()->toggleable(),
                TextColumn::make('subject')->label('Subject')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('description')->label('Description')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('sms_template')->label('Sms Template')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('alert_template')->label('Alert Template')->searchable()->sortable()->limit(40)->toggleable(),
                TextColumn::make('template')->label('Template')->searchable()->sortable()->limit(40)->toggleable(),
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
