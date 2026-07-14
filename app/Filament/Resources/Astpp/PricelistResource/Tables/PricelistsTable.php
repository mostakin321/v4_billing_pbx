<?php
namespace App\Filament\Resources\Astpp\PricelistResource\Tables;

use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Filament\Support\Enums\FontWeight;
use Illuminate\Support\Facades\DB;

class PricelistsTable
{
    public static function configure(Table $table): Table
    {
        return $table->columns([
            TextColumn::make('name')->label('Name')->searchable()->sortable()
                ->weight(FontWeight::Bold),

            TextColumn::make('routing_prefix')->label('Routing Prefix')
                ->default('—')->badge()->color('warning'),

            TextColumn::make('routing_type')->label('Routing Type')
                ->formatStateUsing(fn($state): string => match((int)$state) {
                    0 => 'LCR',
                    1 => 'Priority',
                    2 => 'Percentage',
                    3 => 'Round Robin',
                    default => 'LCR'
                })->badge()->color('info'),

            TextColumn::make('initially_increment')->label('Initial Inc')->default(0),
            TextColumn::make('inc')->label('Increment')->default(0),
            TextColumn::make('markup')->label('Markup (%)')->default(0),

            TextColumn::make('reseller_id')->label('Reseller')
                ->formatStateUsing(fn($state) => $state
                    ? DB::table('accounts')->where('id', $state)->value('company_name') ?? 'Admin'
                    : 'Admin')
                ->badge()->color('gray'),

            TextColumn::make('creation_date')->label('Created')
                ->dateTime('M j, Y')->sortable(),

            TextColumn::make('status')->badge()
                ->formatStateUsing(fn($state): string => $state == 0 ? 'Active' : 'Inactive')
                ->color(fn($state): string => $state == 0 ? 'success' : 'danger'),
        ])
        ->filters([
            SelectFilter::make('status')->options([0 => 'Active', 1 => 'Inactive']),
        ])
        ->actions([
            EditAction::make(),
            Action::make('duplicate')
                ->label('Duplicate')
                ->icon('heroicon-o-document-duplicate')
                ->color('gray')
                ->requiresConfirmation()
                ->modalHeading('Duplicate Rate Group')
                ->modalDescription('This will copy all settings and rates to a new rate group.')
                ->action(function ($record) {
                    // Duplicate pricelist
                    $new = $record->replicate();
                    $new->name = $record->name . ' (Copy)';
                    $new->creation_date = now();
                    $new->last_modified_date = now();
                    $new->save();

                    // Duplicate routes
                    $routes = DB::table('routes')->where('pricelist_id', $record->id)->get();
                    foreach ($routes as $route) {
                        $routeArr = (array) $route;
                        unset($routeArr['id']);
                        $routeArr['pricelist_id'] = $new->id;
                        $routeArr['creation_date'] = now();
                        $routeArr['last_modified_date'] = now();
                        DB::table('routes')->insert($routeArr);
                    }
                }),
            DeleteAction::make(),
        ])
        ->defaultSort('name');
    }
}
