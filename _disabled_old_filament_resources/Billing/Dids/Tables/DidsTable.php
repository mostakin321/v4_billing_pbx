<?php
namespace App\Filament\Resources\Billing\Dids\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Support\Enums\FontWeight;
use Illuminate\Support\Facades\DB;

class DidsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('number')
                ->label('DID Number')->searchable()->sortable()
                ->weight(FontWeight::Bold)->copyable(),

            TextColumn::make('accountid')->label('Account')
                ->formatStateUsing(fn($state) => $state
                    ? DB::table('accounts')->where('id', $state)->value('number') ?? '—'
                    : '—')
                ->badge()->color('info'),

            TextColumn::make('province')->label('Province')->default('—'),
            TextColumn::make('city')->label('City')->default('—'),

            TextColumn::make('cost')
                ->label('Rate/Min')->money('usd'),

            TextColumn::make('monthlycost')
                ->label('Monthly')->money('usd'),

            TextColumn::make('setup')
                ->label('Setup Fee')->money('usd'),

            TextColumn::make('call_type')->label('Type')
                ->formatStateUsing(fn($state) => match((int)$state) {
                    0 => 'Local Ext', 1 => 'SIP URI', 2 => 'Direct IP',
                    3 => 'Custom', 4 => 'Transfer', default => '?'
                })
                ->badge()->color('gray'),

            TextColumn::make('status')->badge()
                ->formatStateUsing(fn($state): string => $state == 0 ? 'Active' : 'Inactive')
                ->color(fn($state): string => $state == 0 ? 'success' : 'danger'),
        ])
        ->filters([
            SelectFilter::make('status')->options([0 => 'Active', 1 => 'Inactive']),
        ])
        ->actions([EditAction::make(), DeleteAction::make()])
        ->defaultSort('number');
    }
}
