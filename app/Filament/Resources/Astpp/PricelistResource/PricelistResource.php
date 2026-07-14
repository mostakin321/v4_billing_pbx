<?php
namespace App\Filament\Resources\Astpp\PricelistResource;
use App\Models\Astpp\Pricelist;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
class PricelistResource extends Resource {
    protected static ?string $model          = Pricelist::class;
    public static function getNavigationGroup(): ?string { return 'Tariff'; }

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-document-text'; }
    public static function getNavigationLabel(): string { return 'Rate Groups'; }
    public static function getNavigationSort(): ?int { return 1; }
    public static function form(Schema $form): Schema { return Schemas\PricelistForm::configure($form); }
    public static function table(Table $table): Table { return Tables\PricelistsTable::configure($table); }
    public static function getPages(): array {
        return [
            'index'  => Pages\ListPricelists::route('/'),
            'create' => Pages\CreatePricelist::route('/create'),
            'edit'   => Pages\EditPricelist::route('/{record}/edit'),
        ];
    }
}
