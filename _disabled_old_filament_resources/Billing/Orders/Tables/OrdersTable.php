<?php
namespace App\Filament\Resources\Billing\Orders\Tables;
use Filament\Support\Enums\FontWeight;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
class OrdersTable {
    public static function configure(Table $table): Table {
        return $table->columns([
            TextColumn::make('order_id')->label('Order #')->searchable()->sortable()->weight(FontWeight::Bold),
            TextColumn::make('accountid')->label('Account')->sortable(),
            TextColumn::make('payment_gateway')->label('Payment')->badge()->color('info'),
            TextColumn::make('payment_status')->label('Status')->badge()
                ->color(fn(string $state): string => match($state){
                    'completed'=>'success','pending'=>'warning','failed'=>'danger',default=>'gray'
                }),
            TextColumn::make('order_date')->label('Date')->dateTime('M j, Y')->sortable(),
        ])
        ->filters([SelectFilter::make('payment_status')
            ->options(['completed'=>'Completed','pending'=>'Pending','failed'=>'Failed'])])
        ->actions([EditAction::make(), DeleteAction::make()])
        ->defaultSort('order_date','desc');
    }
}
