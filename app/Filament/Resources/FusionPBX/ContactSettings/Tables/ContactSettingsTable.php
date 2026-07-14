<?php

namespace App\Filament\Resources\FusionPBX\ContactSettings\Tables;

use Filament\Support\Enums\FontFamily;
use Filament\Support\Enums\FontWeight;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ContactSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('contact_setting_name')
                    ->label('Contact Setting Name')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Medium),
                TextColumn::make('domain.domain_name')->label('Domain')
                    ->label('Domain Uuid')
                    ->searchable()
                    ->limit(40)
                    ->wrap(),
                IconColumn::make('contact_setting_enabled')
                    ->label('Contact Setting Enabled')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                TextColumn::make('insert_date')
                    ->label('Insert Date')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->color('gray'),
                TextColumn::make('contact_setting_uuid')
                    ->label('UUID')
                    ->fontFamily(null)
                    ->color('gray')
                    ->copyable()
                    ->copyMessage('UUID copied')
                    ->limit(20)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('contact_setting_name')
            ->filters([
                TernaryFilter::make('contact_setting_enabled')
                    ->label('Status')
                    ->trueLabel('Enabled only')
                    ->falseLabel('Disabled only'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
