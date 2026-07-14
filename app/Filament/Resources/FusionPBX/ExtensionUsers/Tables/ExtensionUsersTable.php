<?php

namespace App\Filament\Resources\FusionPBX\ExtensionUsers\Tables;

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

class ExtensionUsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('domain.domain_name')->label('Domain')
                    ->label('Domain Uuid')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Medium),
                TextColumn::make('user.username')->label('User')
                    ->label('User Uuid')
                    ->searchable()
                    ->limit(40)
                    ->wrap(),
                TextColumn::make('insert_date')
                    ->label('Insert Date')
                    ->dateTime('M j, Y')
                    ->sortable()
                    ->color('gray'),
                TextColumn::make('extension_user_uuid')
                    ->label('UUID')
                    ->fontFamily(null)
                    ->color('gray')
                    ->copyable()
                    ->copyMessage('UUID copied')
                    ->limit(20)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('domain_uuid')
            ->filters([

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
