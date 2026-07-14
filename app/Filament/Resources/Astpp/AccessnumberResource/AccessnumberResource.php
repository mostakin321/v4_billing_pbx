<?php

namespace App\Filament\Resources\Astpp\AccessnumberResource;

use App\Filament\Resources\Astpp\AccessnumberResource\Pages;
use App\Filament\Resources\Astpp\AccessnumberResource\Schemas\AccessnumberForm;
use App\Filament\Resources\Astpp\AccessnumberResource\Tables\AccessnumberTable;
use App\Models\Astpp\Accessnumber;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Database\Eloquent\Builder;

class AccessnumberResource extends Resource
{
    protected static ?string $model = Accessnumber::class;

    public static function getNavigationGroup(): ?string { return 'ASTPP DID'; }
    public static function getNavigationIcon(): string|Htmlable|null { return 'heroicon-o-user-group'; }
    public static function getNavigationLabel(): string { return 'Accessnumber'; }
    public static function getModelLabel(): string { return 'Accessnumber'; }
    public static function getPluralModelLabel(): string { return 'Accessnumber'; }
    public static function getNavigationSort(): ?int { return 1; }

    public static function form(Schema $schema): Schema
    {
        return AccessnumberForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return AccessnumberTable::configure($table);
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
            'index' => Pages\ListAccessnumberRecords::route('/'),
            'create' => Pages\CreateAccessnumber::route('/create'),
            'edit' => Pages\EditAccessnumber::route('/{record}/edit'),
        ];
    }
}
