<?php
namespace App\Filament\Resources\Billing\Trunks\Tables;
use Filament\Support\Enums\FontWeight;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;

class TrunksTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')
                ->searchable()->sortable()->weight(FontWeight::Bold),
            TextColumn::make('gateway_id')->label('Gateway')
                ->formatStateUsing(fn($state) => $state
                    ? DB::table('gateways')->where('id', $state)->value('name') ?? '—'
                    : '—')
                ->badge()->color('info'),
            TextColumn::make('failover_gateway_id')->label('Failover GW')
                ->formatStateUsing(fn($state) => $state
                    ? DB::table('gateways')->where('id', $state)->value('name') ?? '—'
                    : '—')
                ->default('—')->color('gray'),
            TextColumn::make('provider_id')->label('Provider')
                ->formatStateUsing(fn($state) => $state
                    ? DB::table('accounts')->where('id', $state)->value('company_name') ?? '—'
                    : '—')
                ->default('—'),
            TextColumn::make('codec')->label('Codecs')->default('—'),
            TextColumn::make('maxchannels')->label('CC')->sortable(),
            TextColumn::make('cps')->label('CPS')->sortable(),
            TextColumn::make('id')->label('Routes')
                ->formatStateUsing(fn($state) => DB::table('outbound_routes')
                    ->where('trunk_id', $state)->count())
                ->badge()->color('info'),
            TextColumn::make('status')->badge()
                ->formatStateUsing(fn($state): string => $state == 0 ? 'Active' : 'Inactive')
                ->color(fn($state): string => $state == 0 ? 'success' : 'danger'),
        ])
        ->filters([
            SelectFilter::make('status')->options([0 => 'Active', 1 => 'Inactive']),
        ])
        ->actions([EditAction::make(), DeleteAction::make()])
        ->defaultSort('name');
    }
}
