<?php
namespace App\Filament\Resources\Astpp\TrunkResource;
use App\Models\Astpp\Trunk;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
class TrunkResource extends Resource {
    protected static ?string $model          = Trunk::class;
    public static function getNavigationGroup(): ?string { return 'Carriers'; }

    public static function getNavigationIcon(): string|\Illuminate\Contracts\Support\Htmlable|null { return 'heroicon-o-server'; }
    public static function getNavigationLabel(): string { return 'Trunks'; }
    public static function getNavigationSort(): ?int { return 2; }
    public static function form(Schema $form): Schema { return Schemas\TrunkForm::configure($form); }
    public static function table(Table $table): Table { return Tables\TrunksTable::configure($table); }
    public static function getPages(): array {
        return [
            'index'  => Pages\ListTrunks::route('/'),
            'create' => Pages\CreateTrunk::route('/create'),
            'edit'   => Pages\EditTrunk::route('/{record}/edit'),
        ];
    }
}
