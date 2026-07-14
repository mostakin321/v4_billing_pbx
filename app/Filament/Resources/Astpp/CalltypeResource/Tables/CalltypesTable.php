<?php
namespace App\Filament\Resources\Astpp\CalltypeResource\Tables;
use Filament\Support\Enums\FontWeight;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
class CalltypesTable {
    public static function configure(Table $table): Table {
        return $table->columns([
            TextColumn::make('id')->label('ID')->sortable(),
            TextColumn::make('call_type')->label('Name')->searchable()->sortable()->weight(FontWeight::Bold),
            TextColumn::make('description')->searchable()->default('—'),
            TextColumn::make('status')->badge()
                ->formatStateUsing(fn(string $state): string => match((int)$state){0=>'Active',1=>'Inactive',2=>'Deleted',default=>'?'})
                ->color(fn(string $state): string => match((int)$state){0=>'success',1=>'warning',2=>'danger',default=>'gray'}),
        ])
        ->filters([SelectFilter::make('status')->options([0=>'Active',1=>'Inactive'])])
        ->actions([EditAction::make(), DeleteAction::make()])
        ->defaultSort('id');
    }
}
