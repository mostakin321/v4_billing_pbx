<?php
namespace App\Filament\Resources\Astpp\CalltypeResource;
use App\Models\Astpp\Calltype;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
class CalltypeResource extends Resource {
    protected static ?string $model           = Calltype::class;
    public static function getNavigationGroup(): ?string { return 'Tariff'; }

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-tag'; }
    public static function getNavigationLabel(): string { return 'Call Types'; }
    public static function getNavigationSort(): ?int { return 5; }
    public static function getModelLabel(): string { return 'Call Type'; }
    public static function getPluralModelLabel(): string { return 'Call Types'; }
    public static function form(Schema $form): Schema { return Schemas\CalltypeForm::configure($form); }
    public static function table(Table $table): Table { return Tables\CalltypesTable::configure($table); }
    public static function getRelations(): array { return []; }
    public static function getPages(): array {
        return [
            'index'  => Pages\ListCalltypes::route('/'),
            'create' => Pages\CreateCalltype::route('/create'),
            'edit'   => Pages\EditCalltype::route('/{record}/edit'),
        ];
    }
}
