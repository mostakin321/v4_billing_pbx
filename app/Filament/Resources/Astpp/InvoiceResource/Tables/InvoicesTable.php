<?php
namespace App\Filament\Resources\Astpp\InvoiceResource\Tables;
use Filament\Support\Enums\FontWeight;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
class InvoicesTable {
    public static function configure(Table $table): Table {
        return $table->columns([
            TextColumn::make('number')->label('Invoice #')->searchable()->sortable()->weight(FontWeight::Bold),
            TextColumn::make('type')->badge()->color('info'),
            TextColumn::make('accountid')->label('Account')->sortable(),
            TextColumn::make('generate_date')->label('Date')->dateTime('M j, Y')->sortable(),
            TextColumn::make('due_date')->label('Due')->date('M j, Y'),
            TextColumn::make('status')->badge()
                ->formatStateUsing(fn(string $state): string => match((int)$state){0=>'Paid',1=>'Unpaid',2=>'Overdue',default=>'?'})
                ->color(fn(string $state): string => match((int)$state){0=>'success',1=>'warning',2=>'danger',default=>'gray'}),
        ])
        ->filters([SelectFilter::make('status')->options([0=>'Paid',1=>'Unpaid',2=>'Overdue'])])
        ->actions([EditAction::make()])
        ->defaultSort('generate_date','desc');
    }
}
