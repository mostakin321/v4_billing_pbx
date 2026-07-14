<?php
namespace App\Filament\Resources\Astpp\RatedeckResource;
use App\Models\Astpp\Ratedeck;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
class RatedeckResource extends Resource {
    protected static ?string $model          = Ratedeck::class;
    public static function getNavigationGroup(): ?string { return 'Tariff'; }

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-arrow-trending-down'; }
    public static function getNavigationLabel(): string { return 'Ratedeck'; }
    public static function getNavigationSort(): ?int { return 3; }
    public static function form(Schema $form): Schema { return Schemas\RatedeckForm::configure($form); }
    public static function table(Table $table): Table { return Tables\RatedeckTable::configure($table); }
    public static function getPages(): array {
        return [
            'index'  => Pages\ListRatedeck::route('/'),
            'create' => Pages\CreateRatedeck::route('/create'),
            'edit'   => Pages\EditRatedeck::route('/{record}/edit'),
        ];
    }
}
