<?php
namespace App\Filament\Resources\Astpp\OutboundRouteResource;
use App\Filament\Resources\Astpp\OutboundRouteResource\Pages;
use App\Filament\Resources\Astpp\OutboundRouteResource\Schemas;
use App\Filament\Resources\Astpp\OutboundRouteResource\Tables;
use App\Models\Astpp\OutboundRoute;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
class OutboundRouteResource extends Resource {
    protected static ?string $model           = OutboundRoute::class;
    public static function getNavigationGroup(): ?string { return 'Carriers'; }

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-arrow-trending-up'; }
    public static function getNavigationLabel(): string { return 'Termination Rates'; }
    public static function getNavigationSort(): ?int { return 3; }
    public static function getModelLabel(): string { return 'OutboundRoute'; }
    public static function getPluralModelLabel(): string { return 'OutboundRoutes'; }
    public static function form(Schema $form): Schema { return Schemas\OutboundRouteForm::configure($form); }
    public static function table(Table $table): Table { return Tables\OutboundRoutesTable::configure($table); }
    public static function getRelations(): array { return []; }
    public static function getPages(): array {
        return [
            'index'  => Pages\ListOutboundRoutes::route('/'),
            'create' => Pages\CreateOutboundRoute::route('/create'),
            'edit'   => Pages\EditOutboundRoute::route('/{record}/edit'),
        ];
    }
}
