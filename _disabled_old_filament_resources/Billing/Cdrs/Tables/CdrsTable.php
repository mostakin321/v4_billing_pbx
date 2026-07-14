<?php
namespace App\Filament\Resources\Billing\Cdrs\Tables;

use Filament\Support\Enums\FontWeight;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class CdrsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('sip_user')
                ->label('Account')->searchable()->sortable()
                ->weight(FontWeight::Bold)->copyable(),

            TextColumn::make('callerid')
                ->label('From')->searchable()->copyable(),

            TextColumn::make('callednum')
                ->label('To')->searchable()->sortable()->copyable(),

            TextColumn::make('call_direction')
                ->label('Dir')->badge()
                ->color(fn($state): string => $state === 'inbound' ? 'info' : 'warning'),

            TextColumn::make('callstart')
                ->label('Start')->dateTime('M j H:i:s')->sortable(),

            TextColumn::make('billseconds')
                ->label('Bill Sec')->sortable(),

            TextColumn::make('debit')
                ->label('Debit')->money('usd')->sortable()
                ->color(fn($state): string => (float)$state > 0 ? 'danger' : 'gray'),

            TextColumn::make('cost')
                ->label('Cost')->money('usd')->sortable(),

            TextColumn::make('disposition')
                ->label('Status')->badge()
                ->color(fn($state): string => $state === 'ANSWERED' ? 'success' : 'danger'),
        ])
        ->filters([
            SelectFilter::make('call_direction')
                ->options(['outbound' => 'Outbound', 'inbound' => 'Inbound']),
            SelectFilter::make('disposition')
                ->options(['ANSWERED' => 'Answered', 'FAILED' => 'Failed', 'BUSY' => 'Busy']),
        ])
        ->actions([ViewAction::make()])
        ->defaultSort('callstart', 'desc');
    }
}
