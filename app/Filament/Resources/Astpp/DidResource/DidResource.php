<?php
namespace App\Filament\Resources\Astpp\DidResource;
use App\Models\Astpp\Did;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
class DidResource extends Resource {
    protected static ?string $model          = Did::class;
    public static function getNavigationGroup(): ?string { return 'Billing'; }

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-phone-arrow-down-left'; }
    public static function getNavigationLabel(): string { return 'DIDs'; }
    public static function getNavigationSort(): ?int { return 2; }
    public static function form(Schema $form): Schema { return Schemas\DidForm::configure($form); }
    public static function table(Table $table): Table { return Tables\DidsTable::configure($table); }
    public static function getPages(): array {
        return [
            'index'  => Pages\ListDids::route('/'),
            'create' => Pages\CreateDid::route('/create'),
            'edit'   => Pages\EditDid::route('/{record}/edit'),
        ];
    }
}
