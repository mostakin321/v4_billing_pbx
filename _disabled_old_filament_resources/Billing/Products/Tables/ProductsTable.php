<?php
namespace App\Filament\Resources\Billing\Products\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Support\Enums\FontWeight;
class ProductsTable {
    public static function configure(Table $table): Table {
        return $table->columns([
            TextColumn::make('name')->searchable()->sortable()->weight(FontWeight::Medium),
            TextColumn::make('product_category')->label('Type')->badge()
                ->formatStateUsing(fn(string $state): string => match((int)$state){
                    1=>'Package',2=>'Subscription',3=>'Refill',4=>'DID',default=>'?'
                })->color('info'),
            TextColumn::make('price')->label('Price')->money('usd'),
            TextColumn::make('free_minutes')->label('Free Min'),
            TextColumn::make('status')->badge()
                ->formatStateUsing(fn(string $state): string => $state==='0'?'Active':'Inactive')
                ->color(fn(string $state): string => $state==='0'?'success':'danger'),
        ])
        ->actions([EditAction::make(), DeleteAction::make()])
        ->defaultSort('name');
    }
}
