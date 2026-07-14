<?php
namespace App\Filament\Resources\Billing\Rates\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Support\Enums\FontWeight;
use Illuminate\Support\Facades\DB;

class RatesTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('pricelist_id')->label('Rate Group')
                ->formatStateUsing(fn($state) => $state
                    ? DB::table('pricelists')->where('id', $state)->value('name') ?? '—'
                    : '—')
                ->badge()->color('info'),
            TextColumn::make('pattern')->label('Prefix')
                ->searchable()->sortable()->weight(FontWeight::Medium)->copyable(),
            TextColumn::make('comment')->label('Destination')->searchable()->default('—'),
            TextColumn::make('call_type')->label('Type')
                ->formatStateUsing(fn($state) => $state
                    ? DB::table('calltype')->where('id', $state)->value('call_type') ?? $state
                    : '—')
                ->badge()->color('purple'),
            TextColumn::make('cost')->label('Rate/Min')->money('usd')->sortable(),
            TextColumn::make('connectcost')->label('Connect')->money('usd'),
            TextColumn::make('init_inc')->label('Init(s)'),
            TextColumn::make('inc')->label('Inc(s)'),
            TextColumn::make('precedence')->label('Pri')->sortable(),
            TextColumn::make('status')->badge()
                ->formatStateUsing(fn($state): string => $state == 0 ? 'Active' : 'Inactive')
                ->color(fn($state): string => $state == 0 ? 'success' : 'danger'),
        ])
        ->filters([
            SelectFilter::make('pricelist_id')->label('Rate Group')
                ->options(fn() => DB::table('pricelists')->where('status', 0)->pluck('name', 'id')),
            SelectFilter::make('status')->options([0 => 'Active', 1 => 'Inactive']),
        ])
        ->actions([EditAction::make(), DeleteAction::make()])
        ->defaultSort('pattern');
    }
}
