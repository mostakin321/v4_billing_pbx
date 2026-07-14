<?php
namespace App\Filament\Resources\Billing\Rates;
use App\Models\Billing\Rate;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
class RateResource extends Resource {
    protected static ?string $model          = Rate::class;
    public static function getNavigationGroup(): ?string { return 'Tariff'; }

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-currency-dollar'; }
    public static function getNavigationLabel(): string { return 'Rates'; }
    public static function getNavigationSort(): ?int { return 4; }
    protected static bool   $shouldRegisterNavigation = false;
    public static function form(Schema $form): Schema { return Schemas\RateForm::configure($form); }
    public static function table(Table $table): Table { return Tables\RatesTable::configure($table); }
    public static function getPages(): array {
        return [
            'index'  => Pages\ListRates::route('/'),
            'create' => Pages\CreateRate::route('/create'),
            'edit'   => Pages\EditRate::route('/{record}/edit'),
        ];
    }
}
