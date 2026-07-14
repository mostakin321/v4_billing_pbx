<?php
namespace App\Filament\Resources\Billing\Products;
use App\Models\Billing\Product;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
class ProductResource extends Resource {
    protected static ?string $model           = Product::class;
    public static function getNavigationGroup(): ?string { return 'Products'; }

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-gift'; }
    public static function getNavigationLabel(): string { return 'Products'; }
    public static function getNavigationSort(): ?int { return 1; }
    public static function form(Schema $form): Schema { return Schemas\ProductForm::configure($form); }
    public static function table(Table $table): Table { return Tables\ProductsTable::configure($table); }
    public static function getRelations(): array { return []; }
    public static function getPages(): array {
        return [
            'index'  => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit'   => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
