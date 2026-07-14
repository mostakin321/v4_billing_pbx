<?php
namespace App\Filament\Resources\Billing\AccessNumbers;
use App\Models\Billing\AccessNumber;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
class AccessNumberResource extends Resource {
    protected static ?string $model           = AccessNumber::class;
    public static function getNavigationGroup(): ?string { return 'Products'; }

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-phone-arrow-down-left'; }
    public static function getNavigationLabel(): string { return 'Access Numbers'; }
    public static function getNavigationSort(): ?int { return 2; }
    public static function getModelLabel(): string { return 'Access Number'; }
    public static function getPluralModelLabel(): string { return 'Access Numbers'; }
    public static function form(Schema $form): Schema { return Schemas\AccessNumberForm::configure($form); }
    public static function table(Table $table): Table { return Tables\AccessNumbersTable::configure($table); }
    public static function getRelations(): array { return []; }
    public static function getPages(): array {
        return [
            'index'  => Pages\ListAccessNumbers::route('/'),
            'create' => Pages\CreateAccessNumber::route('/create'),
            'edit'   => Pages\EditAccessNumber::route('/{record}/edit'),
        ];
    }
}
