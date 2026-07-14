<?php
namespace App\Filament\Resources\Astpp\OrderResource;
use App\Models\Astpp\Order;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
class OrderResource extends Resource {
    protected static ?string $model           = Order::class;
    public static function getNavigationGroup(): ?string { return 'CDRs & Billing'; }

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-shopping-cart'; }
    public static function getNavigationLabel(): string { return 'Orders'; }
    public static function getNavigationSort(): ?int { return 3; }
    public static function getModelLabel(): string { return 'Order'; }
    public static function getPluralModelLabel(): string { return 'Orders'; }
    public static function form(Schema $form): Schema { return Schemas\OrderForm::configure($form); }
    public static function table(Table $table): Table { return Tables\OrdersTable::configure($table); }
    public static function getRelations(): array { return []; }
    public static function getPages(): array {
        return [
            'index'  => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit'   => Pages\EditOrder::route('/{record}/edit'),
        ];
    }
}
