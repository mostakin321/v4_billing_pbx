<?php
namespace App\Filament\Resources\Billing\OriginationRates;

use App\Models\Billing\Route;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class OriginationRateResource extends Resource
{
    protected static ?string $model           = Route::class;
    public static function getNavigationGroup(): ?string { return 'Tariff'; }

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-arrow-trending-up'; }
    public static function getNavigationLabel(): string { return 'Origination Rates'; }
    public static function getNavigationSort(): ?int { return 2; }
    public static function getModelLabel(): string { return 'Origination Rate'; }
    public static function getPluralModelLabel(): string { return 'Origination Rates'; }

    public static function form(Schema $form): Schema
    {
        return Schemas\OriginationRateForm::configure($form);
    }

    public static function table(Table $table): Table
    {
        return Tables\OriginationRatesTable::configure($table);
    }

    public static function getRelations(): array { return []; }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListOriginationRates::route('/'),
            'create' => Pages\CreateOriginationRate::route('/create'),
            'edit'   => Pages\EditOriginationRate::route('/{record}/edit'),
        ];
    }
}
