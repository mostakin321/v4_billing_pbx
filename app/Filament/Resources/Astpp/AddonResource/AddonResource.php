<?php

namespace App\Filament\Resources\Astpp\AddonResource;

use App\Filament\Resources\Astpp\AddonResource\Pages;
use App\Filament\Resources\Astpp\AddonResource\Schemas\AddonForm;
use App\Filament\Resources\Astpp\AddonResource\Tables\AddonTable;
use App\Models\Astpp\Addon;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class AddonResource extends Resource
{
    protected static ?string $model = Addon::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP System'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-user-group'; }
    public static function getNavigationLabel(): string { return 'Addons'; }
    public static function getModelLabel(): string { return 'Addons'; }
    public static function getPluralModelLabel(): string { return 'Addons'; }
    public static function getNavigationSort(): ?int { return 7; }

    public static function form(Schema $schema): Schema
    {
        return AddonForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AddonTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();
        $model = $query->getModel();
        $columns = $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());

        if (in_array('deleted', $columns, true)) {
            $query->where('deleted', 0);
        }

        return $query;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAddonRecords::route('/'),
            'create' => Pages\CreateAddon::route('/create'),
            'edit' => Pages\EditAddon::route('/{record}/edit'),
        ];
    }
}
