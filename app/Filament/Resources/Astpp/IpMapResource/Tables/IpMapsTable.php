<?php
namespace App\Filament\Resources\Astpp\IpMapResource\Tables;
use Filament\Support\Enums\FontWeight;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
class IpMapsTable {
    public static function configure(Table $table): Table {
        return $table->columns([
            TextColumn::make('name')->searchable()->sortable()->weight(FontWeight::Bold),
            TextColumn::make('ip')->label('IP Address')
                ->searchable()->copyable()->badge()->color('warning'),
            TextColumn::make('account.number')->label('Account')->badge()->color('info'),
            TextColumn::make('account.company_name')->label('Company')->default('—'),
            TextColumn::make('pricelist.name')->label('Rate Plan')->default('Account Default')->color('gray'),
            TextColumn::make('prefix')->default('—'),
            TextColumn::make('context')->badge()->color('gray'),
            TextColumn::make('status')->badge()
                ->formatStateUsing(fn(string $state): string => $state==='0'?'Active':'Inactive')
                ->color(fn(string $state): string => $state==='0'?'success':'danger'),
        ])
        ->filters([SelectFilter::make('status')->options([0=>'Active',1=>'Inactive'])])
        ->actions([EditAction::make(), DeleteAction::make()])
        ->defaultSort('name');
    }
}
