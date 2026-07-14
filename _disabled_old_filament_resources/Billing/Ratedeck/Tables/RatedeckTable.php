<?php
namespace App\Filament\Resources\Billing\Ratedeck\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Support\Enums\FontWeight;
use Illuminate\Support\Facades\DB;

class RatedeckTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('reseller_id')->label('Reseller')
                ->formatStateUsing(fn($state) => $state
                    ? DB::table('accounts')->where('id', $state)->value('company_name') ?? 'Admin'
                    : 'Admin')
                ->badge()->color('purple'),

            TextColumn::make('pattern')
                ->label('Prefix/Pattern')->searchable()->sortable()
                ->weight(FontWeight::Bold)->copyable(),

            TextColumn::make('destination')
                ->label('Destination')->searchable()->default('—'),

            TextColumn::make('call_type')
                ->label('Type')->badge()->color('gray'),

            TextColumn::make('country_id')->label('Country')
                ->formatStateUsing(fn($state) => $state
                    ? DB::table('countrycode')->where('id', $state)->value('country') ?? '—'
                    : '—'),

            TextColumn::make('cost')
                ->label('Buy Cost/Min')->money('usd')->sortable()->color('danger'),

            TextColumn::make('init_inc')->label('Init(s)'),
            TextColumn::make('inc')->label('Inc(s)'),

            TextColumn::make('status')->badge()
                ->formatStateUsing(fn($state): string => $state == 0 ? 'Active' : 'Inactive')
                ->color(fn($state): string => $state == 0 ? 'success' : 'danger'),
        ])
        ->filters([
            SelectFilter::make('status')
                ->options([0 => 'Active', 1 => 'Inactive']),
        ])
        ->actions([EditAction::make(), DeleteAction::make()])
        ->defaultSort('pattern');
    }
}
