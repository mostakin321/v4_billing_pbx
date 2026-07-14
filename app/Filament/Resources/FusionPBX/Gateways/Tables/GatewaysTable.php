<?php

namespace App\Filament\Resources\FusionPBX\Gateways\Tables;

use App\Services\FreeSwitchEsl;
use Filament\Support\Enums\FontWeight;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class GatewaysTable
{
    private static function getGatewayStatus($record): string
    {
        // sofia identifies gateways by UUID (external::<uuid>), not by human-readable
        // name, and multiple gateways can share the same SIP username -- so UUID is
        // the only safe key to match on.
        $uuid = $record->gateway_uuid ?? '';
        if (empty($uuid)) {
            return 'UNKNOWN';
        }

        $result = FreeSwitchEsl::run("sofia status gateway {$uuid}");
        if ($result['ok'] && !str_contains($result['output'], 'Invalid Gateway')) {
            $output = $result['output'];
            if (preg_match('/State\s*:\s*(\S+)/i', $output, $m)) return strtoupper(trim($m[1]));
            if (str_contains($output, 'REGED'))   return 'REGED';
            if (str_contains($output, 'NOREG'))   return 'NOREG';
            if (str_contains($output, 'FAILED'))  return 'FAILED';
            if (str_contains($output, 'TRYING'))  return 'TRYING';
            if (str_contains($output, 'EXPIRED')) return 'EXPIRED';
        }

        // Fallback: scan the full gateway list for this exact UUID segment only.
        $result = FreeSwitchEsl::run("sofia status gateway");
        if (!$result['ok']) return 'UNKNOWN';
        foreach (explode("\n", $result['output']) as $line) {
            if (!str_contains($line, "::{$uuid} ")) continue;
            if (str_contains($line, 'REGED'))   return 'REGED';
            if (str_contains($line, 'NOREG'))   return 'NOREG';
            if (str_contains($line, 'FAILED'))  return 'FAILED';
            if (str_contains($line, 'TRYING'))  return 'TRYING';
            if (str_contains($line, 'EXPIRED')) return 'EXPIRED';
        }
        return 'UNKNOWN';
    }

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('gateway')
                    ->label('Gateway')
                    ->searchable()->sortable()
                    ->weight(FontWeight::Bold),
                TextColumn::make('username')
                    ->label('Username')
                    ->searchable()->limit(30),
                TextColumn::make('context')
                    ->label('Context')
                    ->color('gray'),
                TextColumn::make('profile')
                    ->label('Profile')
                    ->color('gray'),
                TextColumn::make('register')
                    ->label('Register')
                    ->badge()
                    ->color(fn ($state) => $state === 'true' ? 'success' : 'gray'),
                TextColumn::make('reg_status')
                    ->label('Status')
                    ->badge()
                    ->state(fn ($record): string => static::getGatewayStatus($record))
                    ->color(fn (string $state): string => match ($state) {
                        'REGED'            => 'success',
                        'TRYING'           => 'warning',
                        'FAILED','EXPIRED' => 'danger',
                        default            => 'gray',
                    })
                    ->icon(fn (string $state): string => match ($state) {
                        'REGED'            => 'heroicon-o-check-circle',
                        'TRYING'           => 'heroicon-o-arrow-path',
                        'FAILED','EXPIRED' => 'heroicon-o-x-circle',
                        'NOREG'            => 'heroicon-o-minus-circle',
                        default            => 'heroicon-o-question-mark-circle',
                    }),
                IconColumn::make('enabled')
                    ->label('Enabled')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),
            ])
            ->defaultSort('gateway')
            ->filters([
                TernaryFilter::make('enabled')
                    ->label('Status')
                    ->trueLabel('Enabled only')
                    ->falseLabel('Disabled only'),
            ])
            ->actions([
                Action::make('resync')
                    ->label('Resync')
                    ->icon('heroicon-o-arrow-path')
                    ->color('warning')
                    ->action(function ($record) {
                        FreeSwitchEsl::run("sofia profile external rescan");
                    })
                    ->tooltip('Force re-registration'),
                EditAction::make(),
                DeleteAction::make()
                    ->action(function ($record) {
                        $uuid = $record->gateway_uuid ?? '';
                        if ($uuid) {
                            FreeSwitchEsl::run("sofia profile external killgw {$uuid}");
                        }
                        $record->delete();
                    }),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->action(function ($records) {
                            foreach ($records as $record) {
                                $uuid = $record->gateway_uuid ?? '';
                                if ($uuid) {
                                    FreeSwitchEsl::run("sofia profile external killgw {$uuid}");
                                }
                                $record->delete();
                            }
                        }),
                ]),
            ])
            ->poll('30s');
    }
}
