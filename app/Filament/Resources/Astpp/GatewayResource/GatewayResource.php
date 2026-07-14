<?php
namespace App\Filament\Resources\Astpp\GatewayResource;
use App\Models\Astpp\Gateway;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
class GatewayResource extends Resource {
    protected static ?string $model           = Gateway::class;
    public static function getNavigationGroup(): ?string { return 'Carriers'; }

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-signal'; }
    public static function getNavigationLabel(): string { return 'Gateways'; }
    public static function getNavigationSort(): ?int { return 1; }
    public static function getModelLabel(): string { return 'Gateway'; }
    public static function getPluralModelLabel(): string { return 'Gateways'; }
    public static function form(Schema $form): Schema { return Schemas\GatewayForm::configure($form); }
    public static function table(Table $table): Table { return Tables\GatewaysTable::configure($table); }
    public static function getRelations(): array { return []; }
    public static function getPages(): array {
        return [
            'index'  => Pages\ListGateways::route('/'),
            'create' => Pages\CreateGateway::route('/create'),
            'edit'   => Pages\EditGateway::route('/{record}/edit'),
        ];
    }
}
