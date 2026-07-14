<?php

namespace App\Filament\Resources\FusionPBX\Extensions\Tables;

use App\Services\FreeSwitchEsl;
use Filament\Support\Enums\FontWeight;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class ExtensionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('extension')
                    ->label('Extension')
                    ->searchable()
                    ->sortable()
                    ->weight(FontWeight::Bold)
                    ->copyable(),
                TextColumn::make('effective_caller_id_name')
                    ->label('Name')
                    ->searchable()
                    ->default('—'),
                TextColumn::make('user_context')
                    ->label('Domain')
                    ->searchable()
                    ->color('gray'),
                TextColumn::make('reg_status')
                    ->label('Registered')
                    ->badge()
                    ->state(function ($record): string {
                        $result = FreeSwitchEsl::run(
                            'sofia status profile internal reg ' . $record->extension
                        );
                        if (!$result['ok']) return 'UNKNOWN';
                        $out = $result['output'];
                        if (str_contains($out, 'Total items returned: 0')) return 'UNREG';
                        if (str_contains($out, 'Invalid')) return 'UNKNOWN';
                        if (str_contains($out, $record->extension)) return 'REGED';
                        return 'UNREG';
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'REGED'   => 'success',
                        'UNREG'   => 'danger',
                        default   => 'gray',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'REGED'   => 'heroicon-o-check-circle',
                        'UNREG'   => 'heroicon-o-x-circle',
                        default   => 'heroicon-o-question-mark-circle',
                    }),
                IconColumn::make('enabled')
                    ->label('Enabled')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
                TextColumn::make('extension_uuid')
                    ->label('UUID')
                    ->color('gray')
                    ->copyable()
                    ->limit(20)
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('extension')
            ->filters([
                TernaryFilter::make('enabled')
                    ->label('Status')
                    ->trueLabel('Enabled only')
                    ->falseLabel('Disabled only'),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ])
            ->poll('30s');
    }
}
