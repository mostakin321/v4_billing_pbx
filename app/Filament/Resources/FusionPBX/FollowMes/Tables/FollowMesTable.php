<?php

namespace App\Filament\Resources\FusionPBX\FollowMes\Tables;

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

class FollowMesTable
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
                IconColumn::make('follow_me_enabled')
                    ->label('Follow Me Enabled')
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
                TextColumn::make('follow_me_uuid')
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
                TernaryFilter::make('follow_me_enabled')
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
