<?php
namespace App\Filament\Resources\Billing\AniMaps\Tables;
use Filament\Support\Enums\FontWeight;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
class AniMapsTable {
    public static function configure(Table $table): Table {
        return $table->columns([
            TextColumn::make('number')->label('Caller Number')
                ->searchable()->sortable()->weight(FontWeight::Bold)->copyable(),
            TextColumn::make('account.number')->label('Account')->badge()->color('info'),
            TextColumn::make('account.company_name')->label('Company')->default('—'),
            TextColumn::make('reseller.company_name')->label('Reseller')->default('Admin')->color('gray'),
            TextColumn::make('context')->badge()->color('gray'),
            TextColumn::make('status')->badge()
                ->formatStateUsing(fn(string $state): string => $state==='0'?'Active':'Inactive')
                ->color(fn(string $state): string => $state==='0'?'success':'danger'),
        ])
        ->filters([SelectFilter::make('status')->options([0=>'Active',1=>'Inactive'])])
        ->actions([EditAction::make(), DeleteAction::make()])
        ->defaultSort('number');
    }
}
