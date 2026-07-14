<?php

namespace App\Filament\Resources\Billing\Gateways\Tables;

use Filament\Support\Enums\FontWeight;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class GatewaysTable
{
    protected static function gd($record, string $key, $default = '—')
    {
        $data = json_decode($record->gateway_data ?? '{}', true) ?: [];
        return $data[$key] ?? $default;
    }

    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')
                ->searchable()->sortable()->weight(FontWeight::Bold)->copyable(),

            TextColumn::make('sip_profile_id')->label('SIP Profile')
                ->formatStateUsing(fn($state) => $state
                    ? DB::table('sip_profiles')->where('id', $state)->value('name') ?? '—'
                    : 'Default')
                ->badge()->color('gray'),

            TextColumn::make('accountid')->label('Provider')
                ->formatStateUsing(fn($state) => $state
                    ? DB::table('accounts')->where('id', $state)->value('company_name') ?? DB::table('accounts')->where('id', $state)->value('number') ?? '—'
                    : '—')
                ->badge()->color('purple'),

            TextColumn::make('gateway_data_proxy')
                ->label('SIP Proxy/Host')
                ->state(fn($record) => self::gd($record, 'proxy'))
                ->copyable(),

            TextColumn::make('gateway_data_username')
                ->label('Username')
                ->state(fn($record) => self::gd($record, 'username')),

            TextColumn::make('gateway_data_transport')
                ->label('Transport')
                ->state(fn($record) => strtoupper(self::gd($record, 'register-transport', 'udp')))
                ->badge()
                ->color('info'),

            TextColumn::make('gateway_data_register')
                ->label('Register')
                ->state(fn($record) => self::gd($record, 'register', 'false') === 'true' ? 'Yes' : 'No')
                ->badge()
                ->color(fn($state): string => $state === 'Yes' ? 'success' : 'gray'),

            TextColumn::make('status')->badge()
                ->formatStateUsing(fn($state): string => $state == 0 ? 'Active' : 'Inactive')
                ->color(fn($state): string => $state == 0 ? 'success' : 'danger'),
        ])
        ->filters([
            SelectFilter::make('status')
                ->options([0 => 'Active', 1 => 'Inactive']),
        ])
        ->actions([
            EditAction::make(),
            DeleteAction::make(),
        ])
        ->defaultSort('name');
    }
}
