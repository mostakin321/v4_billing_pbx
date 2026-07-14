<?php
namespace App\Filament\Resources\Billing\AniMaps;
use App\Models\Billing\AniMap;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
class AniMapResource extends Resource {
    protected static ?string $model           = AniMap::class;
    public static function getNavigationGroup(): ?string { return 'Settings'; }

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-phone'; }
    public static function getNavigationLabel(): string { return 'ANI Map'; }
    public static function getNavigationSort(): ?int { return 1; }
    public static function getModelLabel(): string { return 'ANI Map'; }
    public static function getPluralModelLabel(): string { return 'ANI Maps'; }
    public static function form(Schema $form): Schema { return Schemas\AniMapForm::configure($form); }
    public static function table(Table $table): Table { return Tables\AniMapsTable::configure($table); }
    public static function getRelations(): array { return []; }
    public static function getPages(): array {
        return [
            'index'  => Pages\ListAniMaps::route('/'),
            'create' => Pages\CreateAniMap::route('/create'),
            'edit'   => Pages\EditAniMap::route('/{record}/edit'),
        ];
    }
}
