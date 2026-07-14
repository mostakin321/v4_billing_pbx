<?php
namespace App\Filament\Resources\Billing\OutboundRoutes\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Support\Enums\FontWeight;
use Illuminate\Support\Facades\DB;

class OutboundRoutesTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('pattern')
                ->label('Prefix/Pattern')->searchable()->sortable()
                ->weight(FontWeight::Bold)->copyable(),

            TextColumn::make('comment')
                ->label('Destination')->searchable()->default('—'),

            TextColumn::make('trunk_id')->label('Trunk')
                ->formatStateUsing(fn($state) => $state
                    ? DB::table('trunks')->where('id', $state)->value('name') ?? '—'
                    : '—')
                ->badge()->color('warning'),

            TextColumn::make('cost')
                ->label('Cost/Min')->money('usd')->sortable()->color('danger'),

            TextColumn::make('connectcost')->label('Connect')->money('usd'),
            TextColumn::make('init_inc')->label('Init(s)'),
            TextColumn::make('inc')->label('Inc(s)'),
            TextColumn::make('precedence')->label('Pri')->sortable(),

            TextColumn::make('status')->badge()
                ->formatStateUsing(fn($state): string => $state == 0 ? 'Active' : 'Inactive')
                ->color(fn($state): string => $state == 0 ? 'success' : 'danger'),
        ])
        ->filters([
            SelectFilter::make('trunk_id')->label('Trunk')
                ->options(fn() => DB::table('trunks')->pluck('name', 'id')->toArray()),
            SelectFilter::make('status')
                ->options([0 => 'Active', 1 => 'Inactive']),
        ])
        ->actions([EditAction::make(), DeleteAction::make()])
        ->defaultSort('pattern');
    }
}
