<?php
namespace App\Filament\Resources\Billing\IpMaps;
use App\Models\Billing\IpMap;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
class IpMapResource extends Resource {
    protected static ?string $model           = IpMap::class;
    public static function getNavigationGroup(): ?string { return 'Settings'; }

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-server'; }
    public static function getNavigationLabel(): string { return 'IP Map'; }
    public static function getNavigationSort(): ?int { return 2; }
    public static function getModelLabel(): string { return 'IP Map'; }
    public static function getPluralModelLabel(): string { return 'IP Maps'; }
    public static function form(Schema $form): Schema { return Schemas\IpMapForm::configure($form); }
    public static function table(Table $table): Table { return Tables\IpMapsTable::configure($table); }
    public static function getRelations(): array { return []; }
    public static function getPages(): array {
        return [
            'index'  => Pages\ListIpMaps::route('/'),
            'create' => Pages\CreateIpMap::route('/create'),
            'edit'   => Pages\EditIpMap::route('/{record}/edit'),
        ];
    }
}
