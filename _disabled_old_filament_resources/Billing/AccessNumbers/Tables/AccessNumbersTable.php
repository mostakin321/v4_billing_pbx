<?php
namespace App\Filament\Resources\Billing\AccessNumbers\Tables;
use Filament\Support\Enums\FontWeight;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Support\Facades\DB;
class AccessNumbersTable {
    public static function configure(Table $table): Table {
        return $table->columns([
            TextColumn::make('access_number')->label('Access Number')
                ->searchable()->sortable()->weight(FontWeight::Bold)->copyable(),
            TextColumn::make('country_id')->label('Country')
                ->formatStateUsing(fn($state) => $state
                    ? DB::table('countrycode')->where('id', $state)->value('country') ?? '—' : '—')
                ->badge()->color('info'),
            TextColumn::make('description')->limit(50)->default('—'),
            TextColumn::make('status')->badge()
                ->formatStateUsing(fn(string $state): string => $state==='0'?'Active':'Inactive')
                ->color(fn(string $state): string => $state==='0'?'success':'danger'),
        ])
        ->filters([SelectFilter::make('status')->options([0=>'Active',1=>'Inactive'])])
        ->actions([EditAction::make(), DeleteAction::make()])
        ->defaultSort('access_number');
    }
}
